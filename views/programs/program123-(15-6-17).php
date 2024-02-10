<link rel="stylesheet" type="text/css" href="/public/css/courses_css/dashboard.css">
<?php
$curr_date = date("Y-m-d"); 

if($count_program_plans > 0)
{
$subscription = 1;
}
else
{
$subscription = 0;
}

if($isEnrolled > 0 && $getBuyCoursesUser->plan_id==0)
{
  if($block_enrolled == 0)
  { 
  $btn_msg = "Start Learning Now";
  $showalready ="Already Subscribed";
  }
  else
  {
  $btn_msg = "Take This Course";
  $showalready =""; 
  }
}
else if($isEnrolled > 0 && $curr_date < $exp_date)
{ 
  if($block_enrolled == 0)
  { 
  $btn_msg = "Start Learning Now";
  $showalready ="Already Subscribed";
  }
  else
  {
  $btn_msg = "Take This Course";
  $showalready =""; 
  }
}
else
{
  $btn_msg = "Take This Course";
  $showalready ="";
} 
?>
<style type="text/css">

.col-sm-4 {
  width: 49.333333%;  
}
/*.carousel-control {
    position: absolute;
    top: 40%;
    left: -13px;
    width: 40px;
    height: 40px;
    margin-top: 40px;
    font-size: 60px;
    font-weight: 100;
    line-height: 30px;
    color: #ffffff;
    text-align: center;
    background: none !important;
    border: none !important;
    -webkit-border-radius: 23px;
    -moz-border-radius: 23px;
    border-radius: 23px;
    opacity: 0.5;
    filter: alpha(opacity=50);
}*/
.carousel-control {
    position: static;
    /* top: 40%; */
    /* left: -13px; */
    width: 30px;
    height: 30px;
    margin-top: 0;
    font-size: 60px;
    font-weight: 100;
    /* line-height: 30px; */
    /* color: #ffffff; */
    text-align: center;
    background: none !important;
    border: none !important;
    -webkit-border-radius: 23px;
    -moz-border-radius: 23px;
    border-radius: 23px;
    opacity: 0.5;
    filter: alpha(opacity=50);
}
.carousel-control.right {
    right: 0;
    left: auto;
}
.course_row {
    box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.26);
    float: left;
    margin: 5px;
    padding: 0 !important;
    width: 100%;
}

.courses .item {
    background: none repeat scroll 0 0 #F3F3F3;
    margin-top:0 !important;
    padding:0 !important;
    text-align: center;
}

.courses .item .btn {
  background: none repeat scroll 0 0 #AAD3C2;
  border: 0 none;
  color: rgb(255, 255, 255);;
  font-weight: bold;
  padding: 6px 10px;
  text-shadow: none;
  text-transform: uppercase;
}
.lect-text {
    width: 320px;
 }
.lect-text1{
 max-width: 90px;
}

.smlhead {
  text-align:left;
}
.smltext {
  text-align:justify;
  height:100%;
  min-height:0px;
  padding-left: 10px;
}
.catimg {
    background-color: #FFFFFF;
    height: 150px;
    overflow: hidden;
}
.smlhead {
    height: auto;
    min-height: 60px;
    height:100%;
    display: block;
    overflow: hidden;
    margin-bottom: 5px;
}
#cta-sticky {
  height:50px;
  width:100%;
  position:fixed;
  top: 0;
  z-index: 10000;
  display:none;
  background:#FFF;
  /*-webkit-box-shadow: 0 8px 6px -6px #590716;
     -moz-box-shadow: 0 8px 6px -6px #590716;
          box-shadow: 0 8px 6px -6px #590716;*/
      border-bottom: #CCC 1px solid;
}
#cta-sticky ul li {
  display:inline-block;
  /*padding: 0 10px;*/
  padding: 0px 10px 10px 10px;
}
.active1 {
  border-bottom:#C42140 5px solid;
}
.anchor {
  display: block;
  height: 50px; /*same height as header*/
  margin-top: -50px; /*same height as header*/
  visibility: hidden;
}
.stick-menu {
  margin:0;
}
#sticky-anchor {
  display: block;
  height: 55px; /*same height as header*/
  margin-top: -55px; /*same height as header*/
  visibility: hidden;
}
.btn-course-details {
  color: #fff;
  padding: 5px;
  font-size: 12px;
  font-family: 'Open Sans', sans-serif;
  font-weight: 600;
  /* line-height: 1; */
    /* display: block; */
    /*height: 28px;*/
  border: 0;
  text-align: center;
  text-transform: uppercase;
  text-shadow: none;
  background-color: #c42140;
  border-radius: 5px;/*vertical-align: text-top;*/
  float:left;
  margin: 3px 10px 0 0;
}
.btn-take-course {
  color: #fff;
  padding: 5px 7px 5px 5px;
  font-size: 12px;
  font-family: 'Open Sans', sans-serif;
  font-weight: 600;
  /* line-height: 1; */
    /* display: block; */
    height: 28px;
  border: 0;
  text-align: center;
  text-transform: uppercase;
  text-shadow: none;
  background-color: #c42140;
  border-radius: 20px;/*vertical-align: text-top;*/
}
.course-price-box {
  float: right;
  margin: 10px 4% 0 0;
}
.course-price-text {
  /*text-align:center;
  color:#54B551;
  float:left;
  margin: 5px 0;*/
  font-size:18px;
  text-transform:uppercase;
  font-weight: 600;
  margin: 0 15px;
  float:left;
}
.course-price-text span {
  color: #54b551;
  font-size: 26px;
  font-weight: 700;
  /*margin-top: 5px;*/
}
.alr-subs {
  text-align:center;
  color:#54B551;
  float:left;
  margin: 2px 0;
  font-weight: bold;
}
.stick-left {
  float: left;
  width: 40%;
  padding: 15px;
  margin-left: 50px;
}
.cont_mid .lecture_img_tumb {
  height: 100%!important;
  width: 100%!important;
  overflow: hidden;
}
.pb-b .pbb-li p {
  width: 100%!important;
  color: #767676;
  display: inline-block;
}
h1 {
  font-size: 30px;
  line-height: 39px;
}
h1#headd {
  font-size: 37px;
}
.course-price-text span {
  color: #54b551;
  font-size: 20px;
  font-weight: 700;
  /* margin-top: 5px; */
}
.course-price-text {
  font-size: 16px;
  text-transform: uppercase;
  font-weight: 600;
  margin: 0 15px;
  float: left;
}
.cattext_bottom div{
  text-align:left!important;
}
.rightsidebar a:hover {
  color: rgba(51, 51, 51, 0.7)!important;
}
span.thb-n:hover {
  color: #000!important;
}
span.thb-ti:hover {
  color: #000!important;
}
@media screen and (max-width: 980px) {
.cattext1 h4 {
  font-size: 14px;
  font-weight: 500;
  width: 25%;
  margin: 0;
}
a.iframe.cboxElement {
  float: none!important;
  text-align: right;
  width: 100%;
}
/*.lect-text1 {
  float: none!important;
}*/
h1 {
  font-size: 26px;
  line-height: 39px;
}
.col-sm-4 {
  width: 100%;
}
.course_row{
  margin-bottom:10px!important;
}
h1#headd {
  font-size: 34px;
}
.thb-n {
  color: #353535;
  font-size: 13px;
  font-weight: 700;
}
}
@media screen and (max-width: 934px) {
#cta-sticky {
 display: inline-table !important;
 background:#FFF;
}
.course-price-box {
 padding: 15px!important;
 margin: 0 0 0 0px;
 width:50%;
}
.course-price-text {
  font-size: 15px!important;
}
.course-price-text span {
  color: #54b551;
  font-size: 18px!important;
  }
 i.entypo-book {
  margin-right: 0px!important;
}
.course-price-box.course-price-box1 {
  display: none;
}
.course-price-text{
  margin:0px!important;
  float: right!important;
}
}
@media screen and (max-width: 880px) {
.stick-left {
  float: none;
  width: 100%;
  padding: 15px 0px 0px!important;
}
.course-price-box {
  padding: 15px!important;
  float: none;
  margin: 0 0 0 0px;
  width: 100%;
  text-align: left;
  display: flex;
  margin-left: 5.5%;
}
.course-price-text {
  padding-right: 15px;
}
.row-fluid {
  width: 100%;
  margin-top: 7%;
}
.course-price-text {
  margin: 0 0px!important;
}
.alr-subs{
  margin: 0px 0;
  padding-right: 2%;
}
}
@media screen and (max-width: 800px) {
 .stick-left {
 margin-left:10px !important;
}
 .course-price-box {
 margin-left:10px !important;
}
.course-price-text span {
  color: #54b551;
  font-size: 16px!important;
}
}
@media screen and (max-width: 767px) {
  .col-sm-4 { 
  display: inline-flex;
}
.courses .item {
    background: none repeat scroll 0 0;
}
.catimg {
  height: auto;
}
.smlhead {
  height:auto;
}
h1 {
  font-size: 30px;
  line-height: 39px;
}
a.iframe.cboxElement {
  float:right!important;
  width: 16%!important;
}
.lect-text1 {
  float: right!important;
}
a.iframe.send-title.cboxElement {
  float: left!important;
  width: 100%!important;
}
.col-sm-4 {
  width: 49.333333%;
}
.thb-n {
  color: #353535;
  font-size: 16px;
  font-weight: 700;
}
}
@media(max-width:640px){
h1 {
  font-size: 30px;
  line-height: 39px;
}
.logo{
  margin: 30px auto 7px;
}
}
@media screen and (max-width: 500px) {
 .course-price-text {
 margin:0 15px 0 0 !important;
}
 /*.alr-subs {
 padding-right:15px !important;
}*/
 #cta-sticky ul li {
 display: inline-block !important;
 padding: 0px 10px 0 10px !important;
 margin-bottom: 10px !important;
}
/*.lect-text1 {
  float: none!important;
}*/
}
@media(max-width:480px){
span.reviews-number {
  float: left!important;
}
.course_row{
  margin-bottom:10px!important;
  padding-bottom: 4%!important;
}
h1 {
  font-size: 26px;
  line-height: 30px;
}
.smltext {
  font-size: 12px;
  }
.col-sm-4 {
  width: 100%;
  padding:0px;
}
.course-price-text {
  font-size: 13px!important;
}
.course-price-text span{
  font-size:14px!important;
}
.course-price-box {
  margin-left: 5px !important;
  display: block;
  margin-bottom: 5%;
  padding: 15px 0px 0px 15px!important;
}
.alr-subs{
  width:100%;
  float:none;
  text-align:left;
  padding-bottom: 5%;
}
.course-price-text{
  float:none!important;
}
.logo {
  margin: 20% auto 7px;
}
}
@media screen and (max-width: 415px){
a.iframe.cboxElement {
  float: none!important;
  text-align: right;
  width: 100%!important;
}
#sections .cont_mid {
  padding: 10px;
}
.logo {
  margin: 24% auto 7px;
}
}
@media screen and (max-width: 370px) {
/*.btn-take-course {
 float: left !important;
  }*/
.course-price-text {
 margin: 0 20px 0 0 !important;
  }
.btn-take-course {
 margin-bottom: 5px;
  }
.row-fluid {
  width: 100%;
  margin-top: 15%;
  }
.courses .row-fluid {
  margin-top: 5%!important;
}
}
@media screen and (max-width: 350px) {
 #cta-sticky ul li {
 display: block !important;
 padding: 0px 10px 0 10px !important;
 margin-bottom: 10px !important;
 width: 145px;
}
.cattext1 h4 {
  font-size: 14px;
  font-weight: 500;
  width: 37%;
  margin: 0;
}
.row-fluid {
  width: 100%;
  margin-top: 32%;
}
.course-price-box {
  padding: 0px 0px 15px 15px!important;
}
}

</style>
<script>
$(window).scroll(function() {
    if ($(window).scrollTop() < 200) {
        $("#cta-sticky").hide(); // > 100px from top - show div
    }
    else {
        $("#cta-sticky").show();
    }
});
</script>
<script type="text/javascript">
  function checkActiveSection()
{
    var fromTop = jQuery(window).scrollTop() ;
    jQuery('#sections .section').each(function(){
        var sectionOffset = jQuery(this).offset() ;
        if ( sectionOffset.top <= fromTop )
        {
            jQuery('.stick-menu li').removeClass('active1') ;
            jQuery('.stick-menu li[data-id="'+jQuery(this).data('id')+'"]').addClass('active1') ;
            
        }
    }) ;
}

jQuery(window).scroll(checkActiveSection) ;
jQuery(document).ready(checkActiveSection) ;
jQuery('.stick-menu li a').click(function(e){
    var idSectionGoto = jQuery(this).closest('li').data('id') ;
    $('html, body').stop().animate({
      scrollTop: jQuery('#sections .section[data-id="'+idSectionGoto+'"]').offset().top
    }, 300,function(){
        checkActiveSection() ;
    });
     e.preventDefault() ;
}) ;
</script>
<script>
//function sticky_relocate() {
//    var window_top = $(window).scrollTop();
//    var div_top = $('#sticky-anchor').offset().top;
//    if (window_top > div_top) {
//        $('#sticky').addClass('active');
//    } else  {
//        $('#sticky').removeClass('active');
//    }
//}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script>
<script type="text/javascript" src="<?php echo base_url("assets/js/toastr.js"); ?>" id="script-resource-15"></script>
<style>
.toast-title{font-weight:bold}.toast-message{-ms-word-wrap:break-word;word-wrap:break-word}.toast-message a,.toast-message label{color:#fff}.toast-message a:hover{color:#ccc;text-decoration:none}.toast-close-button{position:relative;right:-0.3em;top:-0.3em;float:right;font-size:20px;font-weight:bold;color:#fff;-webkit-text-shadow:0 1px 0 #fff;text-shadow:0 1px 0 #fff;-webkit-opacity:.8;-moz-opacity:.8;-ms-filter:alpha(opacity=80);opacity:.8;filter:alpha(opacity=80)}.toast-close-button:hover,.toast-close-button:focus{color:#000;text-decoration:none;cursor:pointer;-webkit-opacity:.4;-moz-opacity:.4;-ms-filter:alpha(opacity=40);opacity:.4;filter:alpha(opacity=40)}button.toast-close-button{padding:0;cursor:pointer;background:transparent;border:0;-webkit-appearance:none}
.toast-top-full-width{top:0;right:0;width:100%;margin-top:10px;margin-bottom:10px}.toast-bottom-full-width{bottom:0;right:0;width:100%}.toast-top-left{top:12px;left:12px}.toast-top-right{top:12px;right:12px}.toast-bottom-right{right:12px;bottom:12px}.toast-bottom-left{bottom:12px;left:12px}#toast-container{position:fixed;z-index:999999}#toast-container *{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}#toast-container>div{margin:0 0 6px;padding:15px 15px 15px 50px;width:300px;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;background-position:15px center;background-repeat:no-repeat;color:#fff;-webkit-opacity:.8;-moz-opacity:.8;-ms-filter:alpha(opacity=80);opacity:.8;filter:alpha(opacity=80)}#toast-container>:hover{-webkit-opacity:1;-moz-opacity:1;-ms-filter:alpha(opacity=100);opacity:1;filter:alpha(opacity=100);cursor:pointer}#toast-container>.toast-info{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGwSURBVEhLtZa9SgNBEMc9sUxxRcoUKSzSWIhXpFMhhYWFhaBg4yPYiWCXZxBLERsLRS3EQkEfwCKdjWJAwSKCgoKCcudv4O5YLrt7EzgXhiU3/4+b2ckmwVjJSpKkQ6wAi4gwhT+z3wRBcEz0yjSseUTrcRyfsHsXmD0AmbHOC9Ii8VImnuXBPglHpQ5wwSVM7sNnTG7Za4JwDdCjxyAiH3nyA2mtaTJufiDZ5dCaqlItILh1NHatfN5skvjx9Z38m69CgzuXmZgVrPIGE763Jx9qKsRozWYw6xOHdER+nn2KkO+Bb+UV5CBN6WC6QtBgbRVozrahAbmm6HtUsgtPC19tFdxXZYBOfkbmFJ1VaHA1VAHjd0pp70oTZzvR+EVrx2Ygfdsq6eu55BHYR8hlcki+n+kERUFG8BrA0BwjeAv2M8WLQBtcy+SD6fNsmnB3AlBLrgTtVW1c2QN4bVWLATaIS60J2Du5y1TiJgjSBvFVZgTmwCU+dAZFoPxGEEs8nyHC9Bwe2GvEJv2WXZb0vjdyFT4Cxk3e/kIqlOGoVLwwPevpYHT+00T+hWwXDf4AJAOUqWcDhbwAAAAASUVORK5CYII=") !important}#toast-container>.toast-error{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAHOSURBVEhLrZa/SgNBEMZzh0WKCClSCKaIYOED+AAKeQQLG8HWztLCImBrYadgIdY+gIKNYkBFSwu7CAoqCgkkoGBI/E28PdbLZmeDLgzZzcx83/zZ2SSXC1j9fr+I1Hq93g2yxH4iwM1vkoBWAdxCmpzTxfkN2RcyZNaHFIkSo10+8kgxkXIURV5HGxTmFuc75B2RfQkpxHG8aAgaAFa0tAHqYFfQ7Iwe2yhODk8+J4C7yAoRTWI3w/4klGRgR4lO7Rpn9+gvMyWp+uxFh8+H+ARlgN1nJuJuQAYvNkEnwGFck18Er4q3egEc/oO+mhLdKgRyhdNFiacC0rlOCbhNVz4H9FnAYgDBvU3QIioZlJFLJtsoHYRDfiZoUyIxqCtRpVlANq0EU4dApjrtgezPFad5S19Wgjkc0hNVnuF4HjVA6C7QrSIbylB+oZe3aHgBsqlNqKYH48jXyJKMuAbiyVJ8KzaB3eRc0pg9VwQ4niFryI68qiOi3AbjwdsfnAtk0bCjTLJKr6mrD9g8iq/S/B81hguOMlQTnVyG40wAcjnmgsCNESDrjme7wfftP4P7SP4N3CJZdvzoNyGq2c/HWOXJGsvVg+RA/k2MC/wN6I2YA2Pt8GkAAAAASUVORK5CYII=") !important}#toast-container>.toast-success{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADsSURBVEhLY2AYBfQMgf///3P8+/evAIgvA/FsIF+BavYDDWMBGroaSMMBiE8VC7AZDrIFaMFnii3AZTjUgsUUWUDA8OdAH6iQbQEhw4HyGsPEcKBXBIC4ARhex4G4BsjmweU1soIFaGg/WtoFZRIZdEvIMhxkCCjXIVsATV6gFGACs4Rsw0EGgIIH3QJYJgHSARQZDrWAB+jawzgs+Q2UO49D7jnRSRGoEFRILcdmEMWGI0cm0JJ2QpYA1RDvcmzJEWhABhD/pqrL0S0CWuABKgnRki9lLseS7g2AlqwHWQSKH4oKLrILpRGhEQCw2LiRUIa4lwAAAABJRU5ErkJggg==") !important}
#toast-container>.toast-warning{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGYSURBVEhL5ZSvTsNQFMbXZGICMYGYmJhAQIJAICYQPAACiSDB8AiICQQJT4CqQEwgJvYASAQCiZiYmJhAIBATCARJy+9rTsldd8sKu1M0+dLb057v6/lbq/2rK0mS/TRNj9cWNAKPYIJII7gIxCcQ51cvqID+GIEX8ASG4B1bK5gIZFeQfoJdEXOfgX4QAQg7kH2A65yQ87lyxb27sggkAzAuFhbbg1K2kgCkB1bVwyIR9m2L7PRPIhDUIXgGtyKw575yz3lTNs6X4JXnjV+LKM/m3MydnTbtOKIjtz6VhCBq4vSm3ncdrD2lk0VgUXSVKjVDJXJzijW1RQdsU7F77He8u68koNZTz8Oz5yGa6J3H3lZ0xYgXBK2QymlWWA+RWnYhskLBv2vmE+hBMCtbA7KX5drWyRT/2JsqZ2IvfB9Y4bWDNMFbJRFmC9E74SoS0CqulwjkC0+5bpcV1CZ8NMej4pjy0U+doDQsGyo1hzVJttIjhQ7GnBtRFN1UarUlH8F3xict+HY07rEzoUGPlWcjRFRr4/gChZgc3ZL2d8oAAAAASUVORK5CYII=") !important}#toast-container.toast-top-full-width>div,#toast-container.toast-bottom-full-width>div{width:96%;margin:auto}#toast-container .toast-success.black,#toast-container .toast-error.black,#toast-container .toast-info.black,#toast-container .toast-warning.black{background-color:rgba(0,0,0,0.7);color:#fff}.toast{background-color:#030303}.toast-success{background-color:#00a651}.toast-error{background-color:#cc2424}.toast-info{background-color:#21a9e1}.toast-warning{background-color:#f89406}@media all and (max-width:240px){#toast-container>div{padding:8px 8px 8px 50px;width:11em}#toast-container .toast-close-button{right:-0.2em;top:-0.2em}}@media all and (min-width:241px) and (max-width:480px){#toast-container>div{padding:8px 8px 8px 50px;width:18em}#toast-container .toast-close-button{right:-0.2em;top:-0.2em}}@media all and (min-width:481px) and (max-width:768px){#toast-container>div{padding:15px 15px 15px 50px;width:25em}}*,*:before,*:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
</style>
<script type="text/javascript">

//warning
var opts13 = {
  "closeButton": true,
  "debug": false,
  "positionClass": "toast-top-right", //toast-bottom-right
  "onclick": null,
  "showDuration": "100",
  "hideDuration": "1000",
  "timeOut": "10000000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
  };
</script>
<?php  
if($isEnrolled > 0) { 
$startTimeStamp = strtotime(date('Y-m-d'));
$endTimeStamp = strtotime($exp_date);
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400;  // 86400 seconds in one day



if($curr_date > $exp_date)
{
  
  $message['text'] = "This course has been Expired.Click here to <a href='".base_url()."myinfo/mycourses'>Renew Now</a>";
}
else 
{
  $message['text'] = "You Have ".$numberDays." days remaining to view this course.Click here to <a href='".base_url()."myinfo/mycourses'>Renew Now</a>";  
}
$message['type'] = 'error';
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
      
      if($numberDays <= 15)
      {
        if($message['type'] == 'error')
        {
          $save_msg = $message['text'];   
          echo '<script type="text/javascript">toastr.error("'.$save_msg.'", "Subscription Alert", opts13);</script>';  
        }
      }
    

      
    }
    }
} 
?>
<style>
.stars{
    width: 130px;
    height: 26px;
    background: url(http://sandbox.bumbu.ru/ui/external/stars.png) 0 0 repeat-x;
    position: relative;
}

.stars .rating{
    height: 26px;
    background: url(http://sandbox.bumbu.ru/ui/external/stars.png) 0 -26px repeat-x;
}

.stars i{
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    height: 26px;
    width: 130px;
  
}

.stars i + i{width: 104px;}
.stars i + i + i{width: 78px;}
.stars i + i + i + i{width: 52px;}
.stars i + i + i + i + i{width: 26px;}
</style>
<style >
#payment, #subs, #enroll, #preview, #status {
  width: 404px;
  padding-bottom: 2px;
  display: none;
  background: #FFF;
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
  -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
  -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);
}
#payment, #subs, #enroll, #preview, #status {
  display: none;
  position: fixed;
  opacity: 1;
  z-index: 11000;
  left: 50%;
  margin-left: -202px;
  top: 200px;
}
.general-heading {
  /*background-color: #C42140;*/
  color: #fff;
  font-size: 18px;
  font-weight: 600;
  padding: 10px 40px 10px 40px;
  margin: 0;
  border-radius: 3px 3px 0 0;
}
.pay_main_cont {
  padding: 5px 20px 20px 20px;
}
#payment_lean_overlay, #subs_lean_overlay, #enroll_lean_overlay, #preview_lean_overlay, #status_lean_overlay {
  position: fixed;
  z-index: 10000;
  top: 0px;
  left: 0px;
  height: 100%;
  width: 100%;
  background: #000;
  display: none;
}
.pay_modal_close, .sub_modal_close, .enroll_modal_close, .preview_modal_close, .status_modal_close {
  position: absolute;
  top: 12px;
  right: 12px;
  display: block;
  width: 18px;
  height: 18px;
  background-color: transparent;
  z-index: 2;
}
.entypo-cancel-squared {
  color:#CCC;
}
.entypo-cancel-squared:hover {
  color:#fff;
}
</style>
<?php
  /*echo '<pre>';
  print_r($programs);
  echo '</pre>'; */
$lessonsch = array();
$lessonshasvalue = false;
foreach ($days as $day)
{
  $lessonsch = $this->Program_model->getLessons($day->id);
  if(empty($lessonsch))
  {
  continue;
  }
  else
  {
  $lessonshasvalue = true;
  break;
  }
}

$pro_id = (isset($programs->id)) ? $programs->id : '';
$coursetype_details = $this->Program_model->getCourseTypeDetails ($pro_id);
///if($user_id > 0 && $coursetype_details[0]["course_type"] != 0  && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE){?>
<!--<td align="left">
      <?php //echo JText::_("GURU_AVAILABILITY"); ?>
    </td>-->
<?php //}

if($user_id > 0)
{
$date_enrolled = $this->Program_model->datebuynow($pro_id, $user_id);
  
  if(count($date_enrolled) > 0)
  {
    $not_show = true;
  }
  else
  {
    $not_show = false;
  }
  if(!$hasaccess)
  {
    $not_show = FALSE;
  }
  $date_enrolled = (count($date_enrolled) > 0) ? $date_enrolled->buydate : '';
  $date_enrolled = strtotime($date_enrolled);
}

if(isset($date_enrolled)){

  $start_relaese_date1 = (isset($coursetype_details[0]["start_release"])) ? $coursetype_details[0]["start_release"] : '';

  $start_relaese_date = strtotime($start_relaese_date1);

  $start_date =  $date_enrolled;

  $datestring = "%Y-%m-%d";

  $time = time();

  $date_9 = mdate($datestring, $time);

  //$date9 = strtotime($date9);

  $date9 = $date_9;

  $date_9 = date("Y-m-d",strtotime($date9));

  $date9 = strtotime($date9);

  $interval = abs($date9 - $start_date);

  $dif_days = floor($interval/(60*60*24));

  $dif_week = floor($interval/(60*60*24*7));

  $dif_month = floor($interval/(60*60*24*30));

  if((isset($coursetype_details[0]["course_type"])) && $coursetype_details[0]["course_type"] == 1){

    if($coursetype_details[0]["lesson_release"] == 1)
    {
      $diff_start = $dif_days+1;
      $diff_date = $dif_days+1;
    }

    elseif((isset($coursetype_details[0]["lesson_release"])) && $coursetype_details[0]["lesson_release"] == 2){

      //$dif_days_enrolled = $dif_days_enrolled /7;

      $diff_start = $dif_week+1;

      $diff_date = $dif_week+1;

    }

    elseif((isset($coursetype_details[0]["lesson_release"])) && $coursetype_details[0]["lesson_release"] == 3){

      //$dif_days_enrolled = $dif_days_enrolled /30;

      $diff_start = $dif_month+1;

      $diff_date = $dif_month+1;
    }
  }
}
$step_less = 0;
?>
<style type="text/css">
.fancybox-custom .fancybox-skin {
  box-shadow: 0 0 50px #222;
}
 <?php if($user_id > 0) {
?> .fancybox-image, .fancybox-iframe {
 overflow: auto !important;
}
 .fancybox-inner .fancybox-iframe body {
 background: url(<?php echo base_url();
?>public/default/images/lmsbg.jpg) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
}
 .fancybox-overlay {
 background: none repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
}
 <?php
}
else {
?>
/*.fancybox-image, .fancybox-iframe{
    overflow: auto !important;
    }*/
 <?php
}
?>
</style>

<!--/lightbox scripts and style

<script type="text/javascript">

$(function(){

  $(".show_sub").click(function () {

  $('.subcat').slideDown();

  });

  $(".close_sub").click(function () {

  $('.subcat').slideUp();

  });

});

  $(function(){

    $('dl.tabs dt').click(function(){

      $(this)

        .siblings().removeClass('selected').end()

        .next('dd').andSelf().addClass('selected');

    });

  });

function show_hidde(id, patth){

    var div = document.getElementById("table_"+id);

   // var div = document.getElementById("table");

  var td = document.getElementById("td_"+id);

  var img= document.getElementById("img_"+id);

   // if(div != null){

    if(div.style.display == "block"){

      img.src=patth+"arrow-down.gif";

      div.style.display = "none";

      td.style.borderBottom="none";

    }

    else{

      img.src=patth+"arrow-right.gif";

      div.style.display = "block";

      td.style.borderBottom="2px solid rgb(247, 247, 247)";

    }
}
</script> -->

<!--<section class="breadcrumb" style="padding: 10px; margin-bottom: 10px;">
  <div class="container">
      <div class="row">                       
      <div class="col-sm-12" style="width: 100%;">
              <div style="float:left; margin-right:20px; width: 120px;">
        <img src="<?php echo base_url(); ?>public/uploads/programs/img/<?php echo $programs->image;?>"  >
        </div>
                
                <h3 style="color:#2c2c2c; margin-top: 15px; float:left">Your already Enroll for <?php echo $programs->name; ?></h3>               
                <a href="<?php echo base_url();?>programs/lectures/<?php echo $programs->id?>" class="btn-primary_mtb" style="float:right; color:#FFF;">Continue To Course</a>
               
      </div>
    </div>
  </div>
</section>-->

<?php
if($this->session->userdata('payReceivedMsg'))
{
?>
<!--Payment_Status Pop-up-->
<div id="status"  style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 100px;">
  <div id="payment-ct">
    <h3 class="general-heading">Payment Information</h3>
    <a class="status_modal_close" href="#"><i class="entypo-cancel-squared"></i></a>
    <div class="pay_main_cont">
      <div class="tab-content">
        <div>
          <p>Transaction Id : <?php echo $this->session->userdata('transaction_id'); ?></p>
        </div>
        <div>
          <p>Payment Status : <?php echo $this->session->userdata('payReceivedMsg'); ?></p>
        </div>
        <div>
          <p>Reason : <?php echo $this->session->userdata('pending_reason'); ?></p>
        </div>
        <div>
          <p>Amount : <?php echo $this->session->userdata('amount'); ?></p>
        </div>
        <div>
          <p>Acknowledgement : <?php echo $this->session->userdata('ack'); ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="status_lean_overlay" style="display: none; opacity: 0.5;"> </div>
<!--<div style="background-color: #EBF8A4;padding: 10px;border-radius: 5px;border: 2px solid #A2D246;margin:20px"> <?php echo $this->session->userdata('payReceivedMsg'); ?> </div>-->
<?php
  $this->session->unset_userdata('payReceivedMsg');
  $this->session->unset_userdata('transaction_id');
  $this->session->unset_userdata('pending_reason');
  $this->session->unset_userdata('amount');
  $this->session->unset_userdata('ack');
}
?>
<div class="clr"></div>
<section class="container courses">
<div class="row-fluid ">
<div id="system-message-container"></div>
<?php
        if(isset($programs) && !empty($programs))
    { 
      $this->load->helper('access');
      if(isset($programs->level) && $programs->level == 0)
      {
              $level = 'Beginner';
      }

            if(isset($programs->level) && $programs->level == 1)
      {
        $level = 'Intermediate';
      }

            if(isset($programs->level) && $programs->level == 2)
      {
        $level = 'Advanced';  
      } 
            ?>
<div class="coursedetailpage">
  <div class="span3">
    <div class="cont_mid">
      <?php if($programs->image){ ?>
      <!--<div> <img src="<?php echo base_url(); ?>public/uploads/programs/img/<?php echo $programs->image;?>"  > </div>-->
      <div class="lecture_img_tumb"> <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $programs->image;?>"  > </div>
      <?php } ?>
      <h1>
        <?php //echo "About ".$programs->name;?>
      </h1>
      <div class="star_rating_lec"> 
        
        <!------------------------starreview-Start--------------------------> 
        <span class="reviews-col p0-10">
        <?php
        $avg_rating = 0;
        if(count($reviews) > 0)
        {
          $total_rating = NULL;
          foreach($reviews as $review) 
          {
            $total_rating += $review->review_rate;
          }
          $avg_rating = $total_rating/count($reviews);
          //$rate_percent = ($avg_rating/$total_rating)*100;
        }
        ?>
        <?php
        $round1 = round($avg_rating);
        ?>
        <div class="rating-good" style="float: left; width: 45%; margin-top: 1px; margin-bottom: 2px;">
          <div class="rate-ex3-cnt">
            <?php
          for($iii=1;$iii<=5;$iii++)
          {
            if($iii<=$round1)
            {
              ?>
            <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
            <?php
            }
            else
            {
              ?>
            <div id="1" class="rate-btn-1 rate-btn"></div>
            <?php
            }
          }
          ?>
          </div>
        </div>
        
        <!-- <?php echo count($reviewcount); ?><div style="float:left;"> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star-empty"></i> <span style="width: 100%"></span> <span class="review-count" style="width: 100%"></span> </div>--> 
        <a href="#reviews"><span class="reviews-number" style="float: right;"> <?php echo count($reviewcount); ?> Review</span></a> 
        <!------------------------starreview-End--------------------------> 
        
      </div>
      <div style="clear:both;"></div>
      <div class="lecture_by">
        <h5>Lecture By</h5>
      </div>
      <hr style="margin-top:0;"/>
      <div class="smltext"> <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $teacher_info->images; ?>" width="40px" height="40px" class="img-circle" style="float: left;margin-right: 10px;">
        <div style="display:block;"> <a href="<?php echo base_url()."programs/teach_profile/".$teacher_info->id;?>"> <?php echo '<span class="thb-n">'; echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); echo '</span></a>'; ?>
          <?php  $teachdesigh = trim($teacher_info->designation); ?>
          <a href="<?php echo base_url()."programs/teach_profile/".$teacher_info->id;?>"> <span class="thb-ti"><?php echo $teachdesigh ? $teachdesigh :'' ?></span></a> </div>
      </div>
      <hr style="margin-top:10px;"/>
      <div class="txt_lec">
        <p>
          <?php 
      $infoUser = trim($teacher_info->prof_info);
      if(!empty($infoUser))
        {

    ?>
          <?php echo substr($teacher_info->prof_info,0,500).'...'; ?>
          <?php
    }  

    ?>
        </p>
        <p style="display: block; width: 100%; height: 22px;">
          <?php
      if($user_id != $teacher_info->id)
      {
    ?>
          <!-- <a style="text-align:left; float:left;" class="fancybox fancybox.iframe" href="<?php echo base_url()."programs/teach_info/".$teacher_info->id."/".$this->uri->segment(3);?>"> Send Message</a> --> 
          <a style="text-align:left; float:left;" class="iframe send-title" href="<?php echo base_url()."programs/teach_info/".$teacher_info->id."/".$this->uri->segment(3);?>"> Send Message</a>
          <?php
      }
    ?>
          <?php  if(!empty($infoUser))
        {

    ?>
          <a style="text-align:right; float:right;" href="<?php echo base_url()."programs/teach_profile/".$teacher_info->id;?>"> Read More </a>
          <?php
    }  

    ?>
        </p>
      </div>
    </div>
  </div>
</div>
<div id="sections">
<div id="sticky-anchor"></div>
<div id="course" class="anchor"></div>
<div class="span6">
<div class="cont_mid">
<div class="coursebannerinner">
<div class="section" data-id="1"> 
  <!--<img src="<?php echo base_url(); ?>public/default/images/big_courseimg.jpg" alt="" /> -->
  
  <div class="coursecontentholder">
    <h1><?php echo $programs->name; ?></h1>
    <!--<h3> <?php echo character_limiter(strip_tags($programs->description),120); ?> </h3>--> 
  </div>
  <hr />
  <div style="padding: 0;"> <?php echo $programs->description;?>
    <hr />
    <?php
                $urlCourse2 = strtolower($programs->name);      
            $urlCourse2 = trim(str_replace(' ', '-', $urlCourse2));
            $urlCourse2 = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse2);
      ?>
    <!-- <p><b>Category:</b> <a href="<?php echo base_url()."category/view/".$programs->catid;?>"><?php echo $this->Program_model->getCategoryName($programs->catid); ?></a></p> -->
    <p><b>Category:</b> <a href="<?php echo base_url()."courses/".$urlCourse2."/".$programs->catid;?>"><?php echo ucfirst($this->Program_model->getCategoryName($programs->catid)); ?></a></p>
    <!--<input type="button" href="<?php echo base_url()."/programs/payment" ?>"  value="Buy Now" />-->
    <hr />
    <p><b>Certificate Term:</b>
      <?php
              if($programs->certificate_term == 1)
              {
                         echo 'No Certificate';
              }
              if($programs->certificate_term == 2)
              {
                         echo 'After successful completion of all lectures';
              }
              if($programs->certificate_term == 3)
              {
                         echo 'After passing the final exam';
              }
              if($programs->certificate_term == 4)
              {
                         echo 'After passing the exams on an average ';
              }
              if($programs->certificate_term == 5)
              {
                         echo 'After finishing all the lectures and passing the final exam';
              }
              if($programs->certificate_term == 6)
              {
                         echo 'After finishing all the lectures and passing all the exams on an average  ';
              }
            ?>
    </p>
    <hr />
  </div>
  <?php
      $urlCourse = strtolower($programs->name);     
      $urlCourse = trim(str_replace(' ', '-', $urlCourse));
      $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
      ?>
  <?php 
if ($days)
{
?>
  <div class="leftcontent">
    <?php
if ($days)
{
?>
    <div class="buy_background" style="font-size: 15px;"> 
      <!-- <i class="fa fa-caret-right"></i>-->
      <?php 
  if(is_array($buybutton))
  { 
    
    echo $buybutton[0];
    }
    else
  {
    //buy now stage
    $date_enrolled111 = $this->program_model->getBuySource($pro_id, $user_id);
    if($date_enrolled111 > 0)
    {
      
    }
    else
    {
      echo $buybutton;      
      ?>
      <!--Get access to all the tutorials in the course now! <a href="<?php echo base_url()."paypal/index/".$programs->id."/";?>" class="btn btn-info" style="float: right;">Buy Now</a>-->
      <?php
    }
  } 
  ?>
    </div>
    <?php 
}
?>
  </div>
  <br />
</div>

<!-- course section start -->
<div class="section" data-id="2">
  <div id="sticky-anchor1"></div>
  <div class="anchor" id="curriculum"></div>
  <?php 
$allLessonIds = array();
$i=0;

foreach ($days as $day)
{
  $CI = & get_instance();
  $CI->load->model('admin/program_model');
  $mediaid = $this->uri->segment(3);
  $db_mediaaa = $CI->program_model->getMedia_oflayout('mod_m',$day->id);
  $db_texttt = $CI->program_model->getMedia_oflayout('mod_t',$day->id);
  $sectionname = $this->program_model->getSectionName($day->id);  
  ?>
  <div class="leftcontent">
    <div id="coursesection">
      <div class="title"> <?php echo "- ".$day->title; ?>
        <?php if($day->media_id != 0) { ?>
         <span style="float:right;padding-right: 13px;max-width: 94px;">Duration</span>
        <!-- <a style="float:right" class="iframe" href="<?php echo base_url();  ?>programs/preview/<?php echo $day->id ?>">Preview</a>  -->
        <!-- <a style="float:right" class="fancybox fancybox.iframe" href="<?php echo base_url();  ?>programs/preview/<?php echo $day->id ?>">Preview</a> --> 
        <!--<a id="go" name="signup" rel="leanModal" onclick="showPreviewdiv()" href="#signup" >Preview</a>-->
        <?php 
          }elseif($day->media_id == 0) { ?>
        <?php if($db_mediaaa[0]->media_id != 0 || $db_texttt[0]->media_id != 0 ){ ?>
         <span style="float:right;padding-right: 13px;max-width: 94px;">Duration</span>
        <!-- add new condition for preview --> 
        <!-- <a style="float:right" class="iframe" href="<?php echo base_url();  ?>programs/preview/<?php echo $day->id ?>">Preview</a> -->
        <?php }?>
        <?php
          
          }
          elseif ($day->description) {
          ?>
          <span style="float:right;padding-right: 13px;max-width: 94px;">Duration</span>
       <!--  <a style="float:right" class="iframe" href="<?php echo base_url();  ?>programs/preview/<?php echo $day->id ?>">Preview</a>  -->
        <!--<a id="go" name="signup" rel="leanModal" onclick="showPreviewdiv()" href="#signup" >Preview</a>-->
        
        <?php
                       
          } 

            ?>
      </div>
      <div id="coursesectionlecture">
        <?php
            $lessons = $this->Program_model->getLessonNew($day->id);
            //$lessons = $this->Program_model->getLessons($day->id);
            $dayaccess = $day->access;
            ?>
        <ul class="course_cat1">
          <?php
            $j=0;
             $k=0;

            foreach ($lessons as $lesson)
            {

           $texty = $lesson->lecture_duration;

          if($lesson->lecture_type == 'article')
          { 
            $entypo = 'entypo-newspaper';
            //$texty = 'Text';
            //$texty = '<i class="entypo entypo-newspaper"></i>';

          }
          else if($lesson->lecture_type == 'video')
          {
            $entypo = 'entypo-video';
            //$texty = 'Video';
            // $texty = '<i class="entypo entypo-video"></i>';
          }
          else if($lesson->lecture_type == 'pdf')
          {
            $entypo = 'entypo-docs';
            //$texty = 'Doc';
            // $texty = '<i class="entypo entypo-docs"></i>';
          }
          else if($lesson->lecture_type == 'exam')
          {
            $entypo = 'entypo-clipboard';
            //$texty = 'Doc';
            // $texty = '<i class="entypo entypo-docs"></i>';
          }
           else if($lesson->lecture_type == 'video_article')
          {
            $entypo = 'entypo-vcard';
            //$texty = 'Doc';
           // $texty = '<i class="entypo entypo-vcard"></i>';
          }
          else
          {
            $entypo = 'entypo-doc-text';
            //$texty = 'Doc';
            $texty = "<i class='entypo entypo-doc'></i>";
          }
        
                $allLessonIds[] = $lesson->id;
                if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE)
                {
                    if($coursetype_details[0]["course_type"] == 1)
                    {
            if($coursetype_details[0]["lesson_release"] == 1)
                        {
                            $date_to_display = strtotime ( '+'.$step_less++.' day' , $start_date) ;
                        }
                        elseif($coursetype_details[0]["lesson_release"] == 2)
                        {
                            $date_to_display = strtotime ( '+'.$step_less++.' week' , $start_date) ;
                        }
                        elseif($coursetype_details[0]["lesson_release"] == 3)
                        {
                            $date_to_display = strtotime ( '+'.$step_less++.' month' , $start_date) ;
                        }
                    }
                }
        $lessonAccess = $lesson->step_access;
        $access = isAccess($programs->id,$day->id,$lesson->id);
        
          
          
//commmented by yogesh on dated 06-12-2014
//if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)
if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0))
{
  $diff_start = 1;  //hardcoded by yogesh , remove this and solve above issue for $diffstart variable
  if($diff_start >0)
  { 
    ?>
          <a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='outeranchor <?php //echo "fancybox fancybox.iframe";?>' ><span class="s_underline"> <?php echo $lesson->name;?></span></a>
          <?php 
  }
  else
  {
    ?>
          <a href="<?php echo 'javascript:void(0)';?>" class='outeranchor' ><span class="s_underline"> <?php echo ucfirst($lesson->name);?></span></a>
          <?php 
  }
}
else
{ 
  ?>
          <a href="<?php echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='outeranchor <?php //echo ($not_show === TRUE) ? "fancybox fancybox.iframe" : '';?>' ><span class="s_underline"> </span></a>
          <?php 
} 
?>
          <li>
            <div class="catimg" style="display:none;"><img src="<?php echo base_url(); ?>public/default/images/vidimg.jpg" alt="" /></div>
            <div class="cattext1">
              <?php  if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)
      {
                if($diff_start >0)
                { 
            ?>
              <h4 style="float: left; margin-right: 0px;"><a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' ><?php //echo "Lecture ". ++$j ;?></a></h4>
              <div class="smltext" style="margin-top:12px;">
                <h4 style="float: left; margin-right: 0px;"><a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' ><?php //echo "Lecture ". ++$j ;?></a></h4>
                <a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' > <i class="<?php echo $entypo;?>" style=" margin-right: 10px;"></i> 
                <!--<span><?php //echo ucfirst($lesson->name);?></span></a>
          <span style='float:right'><?php //echo ucfirst($texty);?></span>-->
                <div class="lect-text"><?php echo ucfirst($lesson->name);?></div>
                </a>
                <div class="lect-text1" style='float:right'><?php echo ucfirst($texty);?></div>
                <br>
              </div>
              <?php 
        }
                else
                {           
            ?>
              <div class="smltext" style="margin-top:12px;">
                <h4 style="float: left; margin-right: 0px;"><a href="<?php echo 'javascript:void(0)';?>" class='' ><?php //echo "Lecture ". ++$j ;?></a></h4>
                <a href="javascript:void(0)"> <i class="<?php echo $entypo;?>" style=" margin-right: 10px;"></i> 
                <!--<span><?php echo ucfirst($lesson->name); ?></span></a>
          <span style='float:right'><?php echo ucfirst($texty);?></span>-->
                <div class="lect-text"><?php echo ucfirst($lesson->name); ?></div>
                </a>
                <div class="lect-text1" style='float:right'><?php echo ucfirst($texty);?></div>
                <br>
              </div>
              <?php 
        }
            }
            else
            { 
      ?>
              <div class="smltext" style="margin-top:12px;">
                <h4 style="float: left; margin-right: 0px;">
                  <?php 
              if($lesson->layoutid == '12')
              {
                echo "Exam ". ++$k ;
              }
              else
              {
                //echo "Lecture ". ++$j ;
              }

              ?>
                  <!--<a href="<?php //echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='<?php //echo ($not_show === TRUE) ? "fancybox fancybox.iframe" : '';?>' ><?php //echo "Lecture ". ++$j ;?></a>--></h4>
                <!--<a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' >--> 
                <i class="<?php echo $entypo;?>" style=" margin-right: 10px;"></i> 
                <!--<span><?php echo ucfirst($lesson->name);?></span>--><!--</a>-->
                <div class="lect-text"><?php echo ucfirst($lesson->name);?></div>
                <!--<span style='float:right'><?php echo ucfirst($texty);?></span>-->
                <div class="lect-text1" style='float:right'><?php echo ucfirst($texty);?></div>
                <br>
              </div>
              <?php 
      }
      ?>
              <?php
                $lesson_viewed = $this->Program_model->getViewLesson($lesson->id,$user_id,$programs->id);
              if(!$lesson_viewed)
              {
                    $display = "none";
        }
        else
        {
                  $display = "inherit";
        }
                
                if($lesson->difficultylevel == 'easy')
                {
                    $image_name = 'level_icon.png';
                }
                if($lesson->difficultylevel == 'medium')
                {
                    $image_name = 'level_intmed_icon.png';
                }

                if($lesson->difficultylevel == 'hard')
                {
                $image_name = 'level_advance_icon.png';
                }
                @$diff_start--;
                ?>
              <!--<p><span style="display:inline-block; margin-right:10px;">Viewed <img src="<?php echo base_url(); ?>public/default/images/view_icon.png" alt="" /></span><span> Level <img src="<?php echo base_url(); ?>public/default/images/<?php echo $image_name;?>" alt="" /></span></p>--> 
            </div>
            <hr style="margin:0;" />
            <?php /* ?>  <div class="view" style="display:<?php echo $display; ?>;" id="viewed-2">
                <img align="viewed" src="<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/view_icon.png">
            </div>
            <?php */ ?>
            <?php /* ?>         <div class="level">

                    <img src="<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/<?php echo $image_name; ?>">

                    </div>

            <?php */ ?>
          </li>
          <?php
      } // end of foreach lessions
    ?>
        </ul>
      </div>
    </div>
    <!-- course section End --> 
  </div>
  <?php 
} // end of foreach section(day)
?>
  <?php
if(isset($programs->id_final_exam) && ($programs->id_final_exam > 0))
{
?>
  <div class="leftcontent"> 
    <!-- final exam view --> 
    <!-- <div class="title"><?php echo "Final Exam : (".$programs->certificate_course_msg.')'; ?></div> -->
    <div class="title">Final Exam <?php echo $programs->certificate_course_msg ? '('.$programs->certificate_course_msg.')':''; ?></div>
    <div class="submtwo">
      <?php        
      $finalexaminfo = $this->Program_model->getQuiz($programs->id_final_exam);
        $takenwhere = array(
      'user_id'      => $user_id,
        
      'quiz_id'      => $programs->id_final_exam
        
      );
        
      $quiztakeninfo = $this->Program_model->getQuizTaken($takenwhere);
        
      if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE){
        
      if($coursetype_details[0]["course_type"] == 1)
      {
        if($coursetype_details[0]["lesson_release"] == 1)
        {
          $date_to_display = strtotime ( '+'.$step_less++.' day' , $start_date) ;
        }
        
        elseif($coursetype_details[0]["lesson_release"] == 2){
        
        $date_to_display = strtotime ( '+'.$step_less++.' week' , $start_date) ;
        
        }
        
        elseif($coursetype_details[0]["lesson_release"] == 3){
        
        $date_to_display = strtotime ( '+'.$step_less++.' month' , $start_date) ;
        
        }
      }
        
            if(isset($diff_start)){
        
            if($diff_start >=0){
        
            ?>
      <span  style="float:right; margin-right:10px; margin-left:30px; color:#66CC00;"><?php echo 'Available';?></span>
      <?php
        
            }
        
            else{
        
            ?>
      <span  style="float:right; margin-right:10px; margin-left:15px;"><?php echo date('m-d-Y', $date_to_display);?></span>
      <?php
        
            }
        
            }
        
            ?>
      <?php
        
            }
        
            ?>
      <div id="table_28" class="subcat">
        <?php $finalexamactiveflag = false;
        
        if($programs->course_type == 0){
        
          $finalexamactiveflag = true;
        
        }else{
        
        $viewedLessonIds = explode('||',trim($ViewedLessons[0]['lesson_id'],'|'));
        
        $commonLessonIds = array_intersect($allLessonIds,$viewedLessonIds);
        
        if( ($programs->lesson_release == 0) && (count($allLessonIds) == count($commonLessonIds)) ){
        
          $finalexamactiveflag = true;
        
          }
        
          elseif((isset($diff_start))&&($diff_start >=0)){
        
          $finalexamactiveflag = true;
        
          }        
        
        }       
        
        ?>
        <?php
        
           //print_r($finalexamactiveflag);
        
        if(($user_id >0) && $not_show === TRUE)
    {        
      ?>
        <a class="<?php //echo ($finalexamactiveflag) ? 'fancybox fancybox.iframe' : ''?>" href="<?php echo ($finalexamactiveflag) ? base_url().'lessons/finalexam/'.$programs->id.'/'.$programs->id_final_exam : 'javascript:void(0);'?>"> <span class="btn btn-success"> Final Exam:<?php echo $finalexaminfo->name;?></span></a>
        <?php 
    }
    else
    {
      ?>
        <!--<a href="<?php echo 'javascript:void(0)';?>" class='' ><span class="btn btn-success"> Final Exam:<?php echo $finalexaminfo->name;?></span></a>-->
        <?php
    }
    ?>
        <div class="view" id="viewed-2">
          <?php count($quiztakeninfo);?>
          <!--<img style="display:<?php echo (count($quiztakeninfo) > 0) ? '':'none';?>" align="viewed" src="">--> </div>
        <!--src="<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/view_icon.png"-->
        <div class="level"> <img src=""> </div>
        <!--src="<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/level_advance_icon.png"-->
        <hr />
      </div>
    </div>
  </div>
  <?php
}
?>
</div>
<div class="section" data-id="3">
<div id="sticky-anchor2"></div>
<div id="reviews" class="anchor"></div>
<!-- final exam view End -->
<?php if($reviews) { ?>
<!--Rating-->

<div class="title">Rating</div>
<div class="rating-good" style="float: left; width: 45%; margin-top: 15px; margin-bottom: 20px;">
  <div class="rate-ex3-cnt"><?php echo $count_5; ?>
    <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
    <div id="2" class="rate-btn-2 rate-btn rate-btn-active"></div>
    <div id="3" class="rate-btn-3 rate-btn rate-btn-active"></div>
    <div id="4" class="rate-btn-4 rate-btn rate-btn-active"></div>
    <div id="5" class="rate-btn-5 rate-btn rate-btn-active"></div>
  </div>
  <div class="rate-ex3-cnt"><?php echo $count_4; ?>
    <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
    <div id="2" class="rate-btn-2 rate-btn rate-btn-active"></div>
    <div id="3" class="rate-btn-3 rate-btn rate-btn-active"></div>
    <div id="4" class="rate-btn-4 rate-btn rate-btn-active"></div>
    <div id="5" class="rate-btn-5 rate-btn"></div>
  </div>
  <div class="rate-ex3-cnt"><?php echo $count_3; ?>
    <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
    <div id="2" class="rate-btn-2 rate-btn rate-btn-active"></div>
    <div id="3" class="rate-btn-3 rate-btn rate-btn-active"></div>
    <div id="4" class="rate-btn-4 rate-btn"></div>
    <div id="5" class="rate-btn-5 rate-btn"></div>
  </div>
  <div class="rate-ex3-cnt"><?php echo $count_2; ?>
    <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
    <div id="2" class="rate-btn-2 rate-btn rate-btn-active"></div>
    <div id="3" class="rate-btn-3 rate-btn"></div>
    <div id="4" class="rate-btn-4 rate-btn"></div>
    <div id="5" class="rate-btn-5 rate-btn"></div>
  </div>
  <div class="rate-ex3-cnt"><?php echo $count_1; ?>
    <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
    <div id="2" class="rate-btn-2 rate-btn"></div>
    <div id="3" class="rate-btn-3 rate-btn"></div>
    <div id="4" class="rate-btn-4 rate-btn"></div>
    <div id="5" class="rate-btn-5 rate-btn"></div>
  </div>
</div>

<!---Average Rating-->
        <div class="avg_rating" style="">
          <?php
             $total_rating = 0;
           foreach($reviews as $review) 
              {
              $total_rating += $review->review_rate;
              }
              $avg_rating = $total_rating/count($reviews);
              //$rate_percent = ($avg_rating/$total_rating)*100;
          ?>
          <div style="margin-bottom: 10px; font-weight: bold;">Average Rating</div>
                    
        
        <?php
        $round1 = round($avg_rating);
        ?>
        <div style="clear:both;"></div>
        <div class="rating-good" style="float: left; width: 45%; margin-top: 1px; margin-bottom: 2px;">
          <div class="rate-ex3-cnt">
          <?php
          for($iii=1;$iii<=5;$iii++)
          {
            if($iii<=$round1)
            {
              ?>
              <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
              <?php
            }
            else
            {
              ?>
              <div id="1" class="rate-btn-1 rate-btn"></div>
              <?php
            }
          }
          ?>          
          </div>
        </div>
        <div style="clear:both;"></div>
          
          
          <!---Number of Rating-->
          <div style="margin-top: 20px; font-weight: bold;">Number of Review(s)</div>
          <?php  
            //$reviews = $this->program_model->getAllReview($this->url->segment(3));
            //print_r(count($reviewcount));
           ?>
          <div style="margin-left:10px;"><?php echo count($reviewcount); ?></div> 
        </div>
        <div style="clear:both;"></div>
      <?php } ?>
      
      
      <?php if($reviews) { ?>
      <div>
        <div id="reviews" class="title">Reviews</div>
          <?php   foreach($reviews as $review) { ?>
        <div style="margin-top: 10px;">
                  <div style="float: left; margin:0 20px;">
          <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $review->images; ?>" width="70" height="70" class="img-circle" />
                    </div>
                    <div>
                    
          <?php echo $review->first_name.' '.$review->last_name; ?>
          
          <div class="rate-ex3-cnt" style="width: auto;">
            <div id="1" class="rate-btn-1<?php echo $review->review_id; ?> rate-btn"></div>
            <div id="2" class="rate-btn-2<?php echo $review->review_id; ?> rate-btn"></div>
            <div id="3" class="rate-btn-3<?php echo $review->review_id; ?> rate-btn"></div>
            <div id="4" class="rate-btn-4<?php echo $review->review_id; ?> rate-btn"></div>
            <div id="5" class="rate-btn-5<?php echo $review->review_id; ?> rate-btn"></div>
          </div>
                    </div>
          <script>
            $('document').ready(function() {
      
                for (var i = <?php echo $review->review_rate; ?>; i >= 0; i--) {
                  $('.rate-btn-'+i+<?php echo $review->review_id; ?>).addClass('rate-btn-active');
                };  
            });
          </script>
                    
        </div>
                <div style="clear:both;"></div>
        <div style="margin-left: 20px; margin-top: 10px;"><?php echo $review->title;  ?></div>
        <div style="margin-left: 20px; margin-top: 10px;"><?php echo $review->description;  ?></div>
                <hr />
        <?php } ?>
      
      </div>
      <?php } ?>
      </div>
          </div>
         <!--bottom slider start-->
         
         
         <!--bottom slider end///////////////////////////////@@@@@@@@@@@@@@-->

         <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <div style="display:inline-block;"> <a href="<?php echo base_url()."programs/teach_profile/".$teacher_info->id;?>"><?php echo '<span style="font-size: 14px; font-weight: 600; color: #353535;">'; echo "More from"." ".ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); echo '</span></a>'; ?>
               <?php  $teachdesigh = trim($teacher_info->designation); ?>
          <a href="<?php echo base_url()."programs/teach_profile/".$teacher_info->id;?>"> <span class="thb-ti"><?php echo $teachdesigh ? $teachdesigh :'' ?></span></a> </div> 
            <div style="float:right; padding: 0 15px 10px 0;"><a class="btn-course-details" href="<?php echo base_url()."programs/teach_profile/".$teacher_info->id;?>"><!--<i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i>-->View All <i class="entypo-plus"></i></a>
         
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <img src="<?php echo base_url(); ?>public/css/image/slider-left-arrow.jpg" width="28" height="28"> 
            </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><img src="<?php echo base_url(); ?>public/css/image/slider-right-arrow.jpg" width="28" height="28"> 
            
            </a> 
         </div> 
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php 


                $teacher_info = $this->Program_model->getTeacherInfo($teacher_info->id);
              //$wishlist = $this->Category_model->getWishlist($user_id));
                $teachingcourses = $this->Myinfo_model->getTeachingCourses($teacher_info->id);
               // $teachingcourses1 = $this->Myinfo_model->getTeachingCourses($teacher_id));
               // $teacher_info = $teacher_info;
                $m = 0;
                $hover_id = 1;
                foreach ($teachingcourses as $teach_course) {
                		if($teach_course->id != $this->uri->segment(3))
                		{
                	$counts_students = $this->programs_model->getEnrolledUser($teach_course->id);
		   
					$default_plans = $this->program_model->getDefaultPlans($teach_course->id);
		   
					$reviews = $this->program_model->getAllReview($teach_course->id);
					
					$author = $this->Category_model->getAuthor($teach_course->author);
			        $author_img = (isset($author->images)) ? $author->images : '';
			        $first_name = (isset($author->first_name)) ? $author->first_name : '';
			        $last_name = (isset($author->last_name)) ? $author->last_name : '';
			        $lessonsch = array();
			        $lessonshasvalue = false;
			        $days = $CI->Program_model->getlistDays($teach_course->id);

			        foreach ($days as $day)
						{
							
								$lessonsch = $CI->Program_model->getLessonNew($day->id);		
							if(empty($lessonsch))
							{
								continue;
							}
							else
							{
								$lessonshasvalue = true;
								break;
							}
						}
                 if($lessonshasvalue)
					{

					
				$urlCourse = strtolower($teach_course->name);			
				$urlCourse = trim(str_replace(' ', '-', $urlCourse));
				$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
				
                  $img = $teach_course->image;
                   if($m%2==0)
                  {
                     if($m==0)
                     {
                      ?>
                            <div class="item active">
                      <?php
                     }
                     else
                     {
                      ?>
                             </div>
                             <div class="item">
                      <?php
                     }
                   }     
                  ?>
                  <div class="col-sm-4 col-xs-4">
                  <div class="course_row" id='<?php echo $hover_id;?>' onmouseover="show_wishheart(this.id)" onmouseout="hide_wishheart(this.id)" >
          
                         <div id="wishheart<?php echo $hover_id;?>"  class="btn btn-default btn-sm ud-wishlist" style="margin: 10px; position: absolute; z-index: 1; display:none;"> <i class="entypo-heart" style="color:#D04D66;"></i>
                  <?php 
			      $wishlisted = NULL;
			   foreach ($wishlist as $wish_list) 
					  {
						if($wish_list->program_id == $teach_course->id)
						{
						      $wishlisted = 'yes';
							  $wishlist_id = $wish_list->wishlist_id;
						}
					  }
			   ?>
                  <?php
                  $sessionarray = $this->session->userdata('logged_in');

				if($sessionarray)
				{
					if($wishlisted)
					{
			   ?>
                  <span class="in-wishlist none" onclick="ajax_deletewishlist(<?php echo $teach_course->id ?>,<?php echo $wishlist_id ?>,<?php echo $hover_id ?>)">Wishlisted</span>
                  <?php
				    }
					else
					{
				?>
                  <span class="not-in-wishlist" onclick="ajax_addwishlist(<?php echo $teach_course->id ?>,<?php echo $hover_id ?>)">Wishlist</span>
                  <?php
				    }
				 }
				 else
				 {
				 ?>
                   <span class="not-in-wishlist" onclick="showmsg();">Wishlist</span>
				<?php
				 }
				?>
                </div>
                          <div class="catimg">                            
                            <a href="<?php echo base_url() ?>programs/programs/<?php echo $teach_course->id; ?>"> <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $img; ?>"></a>
                          </div>                         

                        <div class="cattext">
                
								<div class="smlhead"><h4><a href="<?php echo base_url() ?>programs/programs/<?php echo $teach_course->id; ?>" style="font-weight: 500; font-size: 15px;"><?php echo character_limiter(strip_tags($teach_course->name),47); ?></a></h4></div>
								<div class="smltext"><?php echo character_limiter(strip_tags($teach_course->description),47); ?></div>
								<div class="cattext_bottom">
								
				                <hr style="margin: 0px 0 10px 0;">
				                <div class="smltext"> <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $author_img; ?>" width="30px" height="30px"> <?php echo '<span>'; echo $name = $first_name.' '.$last_name; echo '</span>'; ?> </div>
				                <hr style="margin: 0px 0 10px 0;">
				                <div style="margin-bottom:10px;">
								<!-- <div style="display:inline-block;"> 
								<span class="gray"></span><i class="fa fa-usd"></i> <span style="color: #54b551; font-weight: 600; font-size: 14px;"><b>
								$40</b></span> 
								</div> -->
								<?php 
									if($default_plans)
									{
								?>
			                    <div style="display:inline-block;"> <span class="gray">Price:</span> <span style="color: #54b551; font-weight: 600 font-size: 14px;"><?php echo $default_plans[0]['price']; ?></span> </div>
			                    <?php
								    }
									else
									{
									   
									   
								?>
			                    <div style="display:inline-block;"> <span class="gray">Price:</span> <span style="color: #54b551; font-weight: 600 font-size: 14px;">
			                      <?php if(intval($teach_course->fixedrate) > 0) { echo $teach_course->fixedrate; } else { echo 'FREE' ;} ?>
			                      </span> </div>
			                    <?php
									}
								?>
								<div style="display:inline-block; float:right;"> <span class="gray">Students:</span> <span class="count"><i class="entypo-user"></i><?php echo count($counts_students);?></span> </div>
				                </div>
				                <div style="clear:both;"></div>
				                <hr style="margin: 0px 0 10px 0;">
                <!------------------------starreview-Start--------------------------> 
                <span class="reviews-col p0-10">
					<?php
				$avg_rating = 0;
				if(count($reviews) > 0)
				{
					$total_rating = NULL;
					foreach($reviews as $review) 
					{
						$total_rating += $review->review_rate;
					}
					$avg_rating = $total_rating/count($reviews);
					//$rate_percent = ($avg_rating/$total_rating)*100;
				}
				?>					
				<style>
					.rate-ex3-cnt{
						width:190px; height: 20px;/* display: block;*/
						
					}
					.rate-ex3-cnt .rate-btn{
						width: 20px; height:20px;
						float: left;
						background: url(http://create-online-academy.com/public/images/rating_img/rate-btn3.png) no-repeat;
						cursor: pointer;
					}
					 .rate-ex3-cnt  .rate-btn-active{
						background: url(http://create-online-academy.com/public/images/rating_img/rate-btn3-hover.png) no-repeat;
					}				
				</style>
				<?php
				$round1 = round($avg_rating);
				?>
					<div class="rating-good" style="float: left; width: 45%; margin-top: 1px; margin-bottom: 2px;">
					<div class="rate-ex3-cnt">
					<?php
					for($iii=1;$iii<=5;$iii++)
					{
						if($iii<=$round1)
						{
							?>
							<div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
							<?php
						}
						else
						{
							?>
							<div id="1" class="rate-btn-1 rate-btn"></div>
							<?php
						}
					}
					?>	
					</div>
				</div>			
				
                <!--<div style="float:left;"> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star-empty"></i> <span style="width: 100%"></span> <span class="review-count" style="width: 100%"></span> </div>-->
                <span class="reviews-number" style="float: right;"> <?php if(count($reviews)>0) echo $total_rating.' '; else echo '0'.' '; ?>Rating</span> </span> 
                <!------------------------starreview-End--------------------------> 
                
              </div>
            </div>
            
                     </div>
                </div>
                 
                  <?php 
                  $m++; 
                  $hover_id++; 
              }
                  }      
                }

                  ?>
               
            </div>
            </div>
            
        <!--dynamic slider--////////////////@@@@@@@@@@@@-->
    


          <!--dynamic slider end-->
        </div>
      </div>
  </div> 
  
    <div class="span3" style="padding-left: 0; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.15);">
    <?php
     $pid = $this->uri->segment(3);
    $default_plans = $this->program_model->getDefaultPlans($pid);
     //echo"<pre>";
                //print_r($teachingcourses);
  if(intval($programs->fixedrate) == 0.00 && ($default_plans['0']['default_new']) == 1)
  {
    if(empty($user_id))
    {
    ?>
        <div style="padding:15px; margin-top:10px;">
        <p style="text-align:center;"><strong style="font-size:18px; text-transform:uppercase; font-weight: 600;">Price :</strong>
    
    <span style="color: #54b551;font-size: 22px;font-weight: 700;margin-top: 5px;">
    <?php 
      if(($default_plans['0']['default_new']) == 1) 
      {
        echo $currency_symbol.$default_plans['0']['price']." / <span style='color: #54b551;font-size: 16px;font-weight: 600;'>".$default_plans['0']['term']." ".$default_plans['0']['period']."</span>"; 
      }
      else 
      {
        echo "FREE";
      }
    ?></span> 

    </p>
    <!--<p><a id="go" rel="leanModal" name="signup" href="#subs"  onclick="showsubsdiv()">Subscriptions Options</a></p>-->
        </div>
        <a class="btn-primary_sub" id="go" rel="leanModal" name="signup" href="#signup" style="margin-left: -15px; margin-right: -15px"><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i><?php if(($default_plans['0']['default_new']) == 1) { echo $btn_msg; } else { echo $btn_msg; } ?></a>
        <?php
      }
    else
    {
      // echo"<pre>";
      // print_r($default_plans);
      // print_r($programs);
    ?>
        <div style="padding:15px; margin-top:10px;">
        <p style="text-align:center;"><strong style="font-size:18px; text-transform:uppercase; font-weight: 600;">Price :</strong> 
        <span style="color: #54b551;font-size: 23px;font-weight: 700;margin-top: 5px;">
        <?php if($assigned) { echo 'FREE'; } 
        else if(($default_plans['0']['default_new']) == 1) { echo $currency_symbol.$default_plans['0']['price']." / <span style='color: #54b551;font-size: 16px;font-weight: 600;'>".$default_plans['0']['term']." ".$default_plans['0']['period']."</span>"; } else { echo "FREE"; } ?></span> </p>
    <!--<p><a id="go" rel="leanModal" name="signup" href="#signup"  onclick="showsubsdiv()">Subscriptions Options</a></p>-->
        </div>
        <a  
    <?php  
      if(($default_plans['0']['default_new']) == 1)
      {
        if($isEnrolled > 0 && $curr_date < $exp_date)
        {
          // echo "href=".base_url()."programs/lectures/".$programs->id;
          echo "href=".base_url().$urlCourse."/lectures/".$programs->id;
        }
        elseif($assigned && $isEnrolled == 0)
        {
          // echo "href=".base_url()."programs/lectures/".$programs->id;
          echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showEnrolldiv()'";
        }
        else
        {
          echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showdiv(".$subscription.")'";
        }
        
        // else
        // {
        //  echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showEnrolldiv()'";
        // }

      }
    
    ?> class="btn-primary_sub" style="margin-left: -15px; margin-right: -15px"><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i><?php if(($default_plans['0']['default_new']) == 1) { echo $btn_msg; } else { echo $btn_msg; } ?></a>
        <?php
        }
      } 
    else
    {
        ?>
      <div>
      <p style="text-align:center;"><strong style="font-size:18px; text-transform:uppercase; font-weight: 600;">Price :</strong> <span style="color: #54b551;font-size: 26px;font-weight: 700;margin-top: 5px;"><?php  if($assigned) { echo 'FREE'; } else if(intval($programs->fixedrate) > 0) { echo $currency_symbol.$programs->fixedrate;} else { echo "FREE";} ?></span> </p>
      <p style="text-align:center;color :#54B551"><strong><?php echo $showalready; ?></strong></p>
      </div>      
      <?php
      if(empty($user_id))
      {
      ?>
      <!--<a class="btn-primary_sub fancybox fancybox.iframe" href="<?php echo base_url();?>programs/payment/<?php echo $programs->id?>"  style="margin-left: -15px; margin-right: -15px"><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i>Take This Course</a>--> 
      <a class="btn-primary_sub" id="go" rel="leanModal" name="signup" href="#signup" style="margin-left: -15px; margin-right: -15px"><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i><?php if(intval($programs->fixedrate) > 0) { echo $btn_msg;} else { echo $btn_msg;} ?></a>
      <?php
      }
      else
      {
        ?>
        <a class="btn-primary_sub" style="margin-left: -15px; margin-right: -15px"
        <?php 
        if($assigned)
        {
          if($isEnrolled > 0)
          {
            // echo "href=".base_url()."programs/lectures/".$programs->id;
            echo "href=".base_url().$urlCourse."/lectures/".$programs->id;
          }
          else
          {
            echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showEnrolldiv()'";
          }
        }

        else if(intval($programs->fixedrate) > 0)
        { 
            //if($isEnrolled > 0 && $curr_date < $exp_date)
          if($isEnrolled > 0 && $getBuyCoursesUser->plan_id==0)
            {
              // echo "href=".base_url()."programs/lectures/".$programs->id;
              if($block_enrolled == 0)
              { 
                echo "href=".base_url().$urlCourse."/lectures/".$programs->id;
              }
              else
              {
                echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showfixdiv()'";
              }
            }
            else
            {
              echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showfixdiv()'";
            }
        }
        else
        {
          if($isEnrolled > 0)
          {
            if($block_enrolled == 0)
            { 
            // echo "href=".base_url()."programs/lectures/".$programs->id;
            echo "href=".base_url().$urlCourse."/lectures/".$programs->id;
            }
              else
              {
                echo"onclick= 'showmsg()'";
              }
          }
          else
          {
            echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showEnrolldiv()'";
          }
        }
        ?>>
          <i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i><?php if(intval($programs->fixedrate) > 0) { echo $btn_msg;} else { echo $btn_msg;} ?></a> <!--href="<?php echo base_url();?>paypal/index/<?php echo $programs->id?>"-->
        <?php   
      }
      }
    ?>
        <div class="fold-left">&nbsp;</div>
        <div class="fold-right">&nbsp;</div>
        <div class="rightsidebar-1">
          <h3>Subscribed Users</h3>
          <p><font color="#000"><b><?php echo $crs_user = $this->Program_model->getEnrolledUserCount($programs->id);?></b></font> <?php if($crs_user == 1){ ?>
                      user is already taking this course</p>
                    <?php } 
                    else{ ?>
                      users are already taking this course</p>
                    <?php } ?>
        </div>
        <hr style="margin:0;" />
        <?php 
    $preq_reqt = $programs->prerequisitesfiles;   //$this->Program_model->getPreqReqts_new($programs->id);
    
    //if(isset($programs->pre_req) && ($programs->pre_req_books) && ($programs->reqmts))
    if(($programs->pre_req!= '') || ($programs->pre_req_books != '') || ($programs->reqmts != '') || count($preq_reqt) > 0)
    {
    ?>
        <div class="rightsidebar-1"> 
          
          <!--id="content"-->
          <h3 style="margin-top:0;">Requirements</h3>
          <?php
          if(trim($programs->pre_req) != "")
          {
            ?>
          <p style="margin-top:0;"><strong>Others:</strong></p>
          <?php
            echo $programs->pre_req;
          }     

          if(count($preq_reqt) > 0)
          {
            ?>
          <p style="margin-top:0;"><strong>Prerequisites Course(s):</strong></p>
          <?php        $preq_reqt = explode(',',$preq_reqt);
            foreach($preq_reqt as $requirements)
            {
              $name_course = $this->Program_model->getProgramName($requirements);
              echo $name_course.'<br>';
            }   
          }                 

          if(trim($programs->pre_req_books) != "")
          {
            ?>
          <p><strong>Books :</strong></p>
          <?php
            echo $programs->pre_req_books;
          }

          if(trim($programs->reqmts) != "")
          {
            ?>
          <p><strong>Misc:</strong></p>
          <?php
            echo $programs->reqmts;
          }  
        ?>
        </div>
        <hr/>
        <?php 
    }
?>
        
<!--Webinar Start-->
<?php
//echo $this->Program_model->checkEnrolled($user_id,$pro_id);
  
   //exit('yes');
   $exercise = $programs->programmedias; //$this->Program_model->getExercise($pro_id)
  if(($this->Program_model->checkEnrolled($user_id,$pro_id)) && !empty($exercise))  
  {
    ?>
    <div style="padding: 0px 20px 0px 20px; background-color: #fff;">
        <h3>Exercise Files</h3>
    </div>
    <div class="rightsidebar" style="padding-left: 20px;">
        <?php
          $get_media_ids2 = explode(',',$programs->programmedias);
          
          foreach($get_media_ids2 as $get_media_id)
          { 
             $exfileinfo = $this->Program_model->getExercise($get_media_id);
             //print_r($exerciseFile);  
  //        }
           
    // foreach($exercise as $exfileinfo)
    // {      
      if($exfileinfo->type=='file')
      {
        $pathurl = 'files';
      } 
      if($exfileinfo->type=='image')
      {
        $pathurl = 'images';
      }       
      if($exfileinfo->type=='video')
      {
        $pathurl = 'videos';
      } 
      if($exfileinfo->type=='docs')
      {
        $pathurl = 'documents';
      }
      
      //echo '<a target="_blank" style="text-align:center;" class="btn btn-white" href="'.base_url().'public/uploads/files/'.$exfileinfo->local.'"><i class="entypo-attach" style="margin-right:15px;"></i>|'.$exfileinfo->name.'</a><br />';echo '<a target="_blank" style="text-align:center;" class="btn btn-white" href="'.base_url().'public/uploads/files/'.$exfileinfo->local.'"><i class="entypo-attach" style="margin-right:15px;"></i>|'.$exfileinfo->name.'</a><br />';
      echo '<a target="_blank" style="color:#0C0C0C; text-align:left; padding:10px 0px; display: block;" href="'.base_url()."public/uploads/$pathurl/".$exfileinfo->media_title.'"><i class="entypo entypo-play" style="font-size:12px;"></i>'.$exfileinfo->alt_title.'<i class="entypo entypo-download" style="color:#000;padding-left: 2%;font-size:12px;"></i>'.'</a>';
    }
    ?>
      </div>
      <hr />
      <?php 
  }
 // print_r($programs);
  if(($programs->webstatus=="active") && !empty($webinars))
  {
  //	echo"yes";
  if($this->Program_model->checkEnrolled($user_id,$pro_id))
    {
    ?>
    <div style="padding:0 20px; background-color: #fff;">
      <h3 style="margin: 0;">Webinar</h3>
    </div>
    <div class="rightsidebar-1">
    <table class="table table-bordered table-responsive collaptable"> 
         
         <tbody id="webinarbody">
        <tr>
        <th><span>Webinar</span></th>
                <th><span>Date & Time</span></th>
                <th><span>action</span></th>
        </tr>
        <?php
        $ii =1;   
    foreach($webinars as $webinar)
    {
      ?>
      <?php if($ii == 1){?>
      <?php $attributes = array('class' => 'tform', 'id' => 'webinarpost'.$webinar->proid, 'name' => 'webinarpost'.$webinar->proid);
      echo form_open(base_url().'conwebinar/',$attributes); ?>
      <input type="hidden" value="<?php echo $userfname; ?>" name="ufname">
      <input type="hidden" value="<?php echo $usermail; ?>" name="uemail">
      <input type="hidden" value="<?php echo $webinar->proid; ?>" name="progid">
      <input type="hidden" value="<?php echo $webinar->id; ?>" name="webinarid">
      <!-- <div style="display:inline-block; width:100%; padding:0;">  -->
      <tr>
      <td><span style="float:left"><?php echo ucfirst($webinar->title); ?> &nbsp</span></td>
      <td><span style="float:left"><?php $date = new DateTime($webinar->fromdate); echo $date->format('d M y').' at '. $webinar->fromtime.' GMT';?></span></td>
      <!-- <span style="float:left"><?php echo ucfirst($webinar->fromtime);?></span> -->

      <td><input type="submit" class="btn btn-orange" style="float:right;" value="Go" name="submit"></td></tr>
      <?php echo form_close();?> <!-- </div> -->
      <?php 
    }
    else
    {
      ?>
      <?php $attributes = array('class' => 'tform', 'id' => 'webinarpost'.$webinar->proid, 'name' => 'webinarpost'.$webinar->proid);
      echo form_open(base_url().'conwebinar/',$attributes); ?>
      <input type="hidden" value="<?php echo $userfname; ?>" name="ufname">
      <input type="hidden" value="<?php echo $usermail; ?>" name="uemail">
      <input type="hidden" value="<?php echo $webinar->proid; ?>" name="progid">
      <input type="hidden" value="<?php echo $webinar->id; ?>" name="webinarid">
      <!-- <div style="display:inline-block; width:100%; padding:0;">  -->
      <tr data-id="<?php echo $ii ?>" data-parent="<?php echo $ii == 2 ? '': 2; ?>">
      <td><span style="float:left"><?php echo ucfirst($webinar->title); ?> &nbsp</span></td>
      <td><span style="float:left"><?php $date = new DateTime($webinar->fromdate); echo $date->format('d M y').' at '. $webinar->fromtime.' GMT';?></span></td>
      <!-- <span style="float:left"><?php echo ucfirst($webinar->fromtime);?></span> -->

      <td><input type="submit" class="btn btn-orange" style="float:right;" value="Go" name="submit"></td></tr>
      <?php echo form_close();?> <!-- </div> -->
      <?php
    }
      ?>
      <?php 
      $ii++;
    }
    ?>
    <!-- <td colspan="3"><a href="javascript:void(0);" class="act-button-expand-all">View All Webinars</a></td> -->
    </tbody>
    </table>
    </div>
    <?php
    }
    }
    ?>
      <!--Webinar End-->
      
    <div class="rightsidebar"> 
        <!-- Teacher Info --> 
        <!--
        <div>
                <?php
                if($programs->author != '0'){
                $this->load->view('programs/teacher_info');?>
                <?php } ?>
        </div>
    --> 
        <!-- End Teacher Info --> 
  </div>
    <?php
    if($not_show==false)
    { 
        if($user_id >0)
      {
        $linkfreeandbuy = ($programs->chb_free_courses)?base_url().'programs/enroll/'.$programs->id:base_url().'buyitems/buynow/'.$programs->id;
        }
      else
      {
        $linkfreeandbuy = base_url().'users/login';
        }

      ?>
      <!--<a href="<?php echo $linkfreeandbuy; ?>" style="margin-left: -15px; margin-right: -15px" class="btn-primary_sub"><i class="entypo-basket" style="color:#FFFFFF;margin-right:10px;"></i><?php echo (($programs->chb_free_courses) ? "Start Learning Now":"Take This Course");?> <span>-->
      <?php/* if($programs->chb_free_courses)
            {
                echo "Free";
            }else
            {
              $courseprice=$this->Program_model->getCoursePrice($programs->id);
              echo "$".$courseprice;
            } */?>
      <!--</span></a>
      <div class="fold-left">&nbsp;</div>
      <div class="fold-right">&nbsp;</div>-->
      <?php 
    }
    ?>
    <?php if(isset($teacher_info->first_name)) { ?>
    <ul class="pb-b">
        <!--<li class="pbb-li nlp-coupon ud-discover-tracker"><b>Released:</b>-->
          <!--<p><?php //echo date('d-m-Y',strtotime($programs->startpublish)); ?>
            <?php } ?>
          </p>
        </li>-->
        <li class="pbb-li nlp-coupon ud-discover-tracker"><b>Trainer:</b>
          <p><?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?></p>
        </li>
        <li class="pbb-li nlp-coupon ud-discover-tracker"><b>Level:</b>
          <p> <?php echo $level; ?></p>
        </li>
    </ul>
    
    <div id="wishlist">
    <?php
    $sessionarray = $this->session->userdata('logged_in');        
        if($sessionarray)
        {
      if(count($wishlist) > 0)
      {
        ?>
        <a href="javascript:void(0)" class="btn-primary_sub" onclick="ajax_deletewishlist(<?php echo $programs->id; ?>,<?php echo $wishlist[0]['wishlist_id'];  ?>)" style="margin-left: -15px; margin-right: -15px">
        <i class="entypo-heart" style="color:#fff; margin-right:10px;"></i>
        <span>Wishlisted</span>
        </a>
        <?php
      }
      else
      {
        ?>
        <a href="javascript:void(0)" class="btn-primary_sub" onclick="ajax_addwishlist(<?php echo $programs->id ?>)" style="margin-left: -15px; margin-right: -15px">
        <i class="entypo-heart" style="color:#fff; margin-right:10px;"></i>
        <span>Add To Wishlist</span>
        </a>
        <?php
        }
      }
      else
      {
    ?>
    <a id="go" rel="leanModal" name="signup" href="#signup" class="btn-primary_sub"  style="margin-left: -15px; margin-right: -15px">
        <i class="entypo-heart" style="color:#fff; margin-right:10px;"></i>
        <span>Add To Wishlist</span>
        </a>
    <?php
    }
    ?>
    </div>
    
    <div class="fold-left">&nbsp;</div>
    <div class="fold-right">&nbsp;</div>
    </div>
  </div>
  <div id="main" role="main">
    <div class="holder" id="mrp-container2">
    <?php
} // end of if days
else
{
   echo "there is no record in the database";
}
}
?>
    </div>
  </div>
</div>
</section>
<script>
  function ajax_addwishlist(pro_id)
  { 
        var  dataString = pro_id;       
      
        $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>programs/add_wishlist",
            data    : {'pro_id':dataString},
 
      success: function(data){
        $("#wishlist").html(data); 
      } 
      }); 
  }
</script> 
<script>
  function ajax_deletewishlist(pro_id,wishlist_id)
  {   
        var  dataString1 = wishlist_id;
        var  dataString3 = pro_id;
      
        $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>programs/delete_wishlist",
            data    : {'wishlist_id':dataString1,'pro_id':dataString3},
      success: function(data){
      
        $("#wishlist").html(data); 
      }
      });
    }
</script> 

<!--Payment Option Popup-->
<div id="payment"  style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 100px;">
  <div id="payment-ct"> 
    
    <!--Subscription options-->
    <form id="subs_option" >
      <h3 class="general-heading">Subscription Options</h3>
      <a class="sub_modal_close" href="#" onclick="pay_close()"><i class="entypo-cancel-squared"></i></a>
      <div class="pay_main_cont" style="height: 333px; overflow-y: auto;">
        <div class="tab-content"> 
          
      <?php         
      foreach($program_plans as $prog_plan)
      {
      ?>
      <div style="width:100%; padding-top: 10px;">
            <div class="tile-stats">
              <div class="tile-header">
                <input type="radio"  name="plan_radio" id="plan_radio" value="" <?php if($prog_plan->default_new == 1) echo 'checked'; ?>/>
                <h3 style="color: #fff;"><?php echo $prog_plan->name; ?></h3>
                </div>
        <div style="margin-top: 15px; float: left;">
                <h3 style="float:left; margin-right: 10px; margin-left: 45px;">Price :&nbsp;<i class="fa fa-usd"></i><?php echo $currency_symbol.$prog_plan->price; ?></h3>
                <p><?php echo $prog_plan->term.'/'.$prog_plan->period; ?></p>
        </div>
                
              <div style="margin-top: 10px; margin-bottom: 10px; margin-right: 10px; float: right;">
                <!-- <button type="button"  onclick="showodiv(<?php echo $prog_plan->price;  ?>)" id="subs_button" class="btn btn-success">Subscribe</button> -->
               <button type="button"  onclick="showodiv(<?php echo $prog_plan->plan_id;  ?>)" id="subs_button" class="btn btn-success">Subscribe</button>

                </div>
            </div>
      </div>
      <?php
      }
      ?> 
        </div>
      </div>
    </form>
    
    <!--Confirm Purchase-->
    <?php $attributes = array('class' => 'tform', 'id' => 'conf_purchase' , 'style' => 'display:none');
   // echo form_open_multipart(base_url().'programs/payment', $attributes); 
    echo form_open_multipart(base_url().'paymentprocess/payment_Process', $attributes);
    ?>
    <!--<form id="conf_purchase" style="display:none" >-->
    
    <h3 class="general-heading">Confirm Purchase</h3>
    <a class="pay_modal_close" href="#" onclick="pay_close()"><i class="entypo-cancel-squared"></i></a>
    <div class="pay_main_cont">
      <div>
      
        <ul class="nav nav-tabs bordered">
          <!-- available classes "bordered", "right-aligned" -->
          <!--<li class="active"> <a href="#credit" data-toggle="tab"> <span class="visible-xs"><i class="entypo-home"></i></span> <span class="hidden-xs">Credit</span> </a> </li>-->
          <?php
            if($pay_setting['0']['paypal_status'] == 1)
            {
         ?>
          <li class="active"> <a href="#paypal" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Paypal</span> </a> </li>
          <?php
              }
              if($pay_setting['0']['directpay_status'] == 1)
              {
          ?>
          <li> <a href="#direct" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Other Information</span> </a> </li>
          <?php
              }
          ?>
        </ul>
      </div>
      <div class="tab-content">        

        <?php
            if($pay_setting['0']['paypal_status'] == 1)
            {
         ?>
        <div class="tab-pane active" id="paypal" style="padding:15px 10px 0 10px; border:0; ">
          <!-- <input type="hidden" name='price' id="price"    value="<?php echo $programs->fixedrate=="0.00" ? $default_plans['0']['price']  : $programs->fixedrate;?>"  style="width:100%; border: 1px solid #C7C7C7; height:40px;"  />  -->
          <!-- <input type="hidden" name='price' id="price"    value="<?php echo $programs->fixedrate;?>"  style="width:100%; border: 1px solid #C7C7C7; height:40px;"  /> -->
          
          <input type="hidden" name="course_id" value="<?php echo $programs->id; ?>" />
          <input type="hidden" id="plan_id" name="plan_id" value="" />

          <div> <?php echo form_submit( 'submit', 'Go To Paypal', "class='btn btn-info'"); ?> 
            <!--<input type="submit" name="" class="btn btn-info" id="" value="Go To Paypal" />--> 
          <!-- <a href="<?php echo base_url(); ?>paymentprocess/payment_Process/<?php echo $this->uri->segment(3); ?>">Go To Paypal</a> -->
          </div>
          <div style="color: #8392A3; font-size: 13px; margin-top:10px;"> You will be redirected to Paypal's payment page and then sent back once you complete your purchase. </div>
          <div style="color: #8392A3; font-size: 13px; margin-top:10px;"> By clicking the "Pay" button, you agree to these <a href="#" target="_blank"><b>Terms of Service</b></a>. </div>
          <div style="color: #8392A3; font-size: 13px; text-align:center; margin-top:10px;"> <a href="#"><i class="entypo-lock-open"></i>Secure Connection</a> </div>
        </div>
        <?php
          }
          if($pay_setting['0']['directpay_status'] == 1)
            {
        ?>
        <div class="tab-pane" id="direct" style="padding:15px 10px 0 10px; border:0; ">
          <div>
            <!-- <input type="text" name='cardholder' placeholder="Name on card"   value="" style="width:100%; border: 1px solid #C7C7C7; height:40px;"/> -->
            <?php 

            $Otherpay = $this->settings_model->getAccountMode();

            foreach ( $Otherpay as $Otherpay2) {
               
            
            
            ?>
          <!-- <textarea id ="directpay" name="directpay" rows="5" placeholder="Other Information" value="" style="width:100%; border: 1px solid #C7C7C7;"><?php echo $Otherpay2['directinfo']; ?></textarea> -->
          <div> <?php echo $Otherpay2['directinfo']; ?> </div>
          <div id="request_exist"></div>
          <?php  } ?>
          </div>
          <div> <?php echo form_submit( 'submit', 'Direct Payment',  "class='btn-primary_red'"); ?></div>
        </div>
        <?php
          }
        ?>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <!--</form>--> 
  </div>
</div>
<div id="payment_lean_overlay" style="display: none; opacity: 0.5;"> </div>
<!--<script type="text/javascript">
  $(document).ready(function () {
    $('#go').click(function() {
        $("#subs_option").show();
  
    });
});
</script>--> 
<script type="text/javascript">

    function pay_close(){
    	 $("#payment").hide();     
         $("#payment_lean_overlay").hide(); 
    }
  //$(document).ready(function () {
    // $('.pay_modal_close').click(function() {
    //     $("#payment").hide();     
    //     $("#payment_lean_overlay").hide();      
    // });
//});
</script> 

<!--<script type="text/javascript">
  $(document).ready(function () {
    $('#subs_button').click(function() {
        $("#subs_option").hide();     
        $("#conf_purchase").show();     
    });
});
</script>--> 

<script>
function showodiv(j)
{
  
  var price = j;  

  document.getElementById("plan_id").value = price; //.toFixed(2); //returns 2489.82
  
  document.getElementById("conf_purchase").style.display = 'block';
  document.getElementById("subs_option").style.display = 'none';
}
</script> 
<script>
function showprev()
{
  
  
  document.getElementById("conf_purchase").style.display = 'none';
  document.getElementById("subs_option").style.display = 'block';
}
</script> 
<script>
/*function showdiv()
{
  document.getElementById('payment').style.display = 'block';
}*/
 function showdiv(i){
       
    /* if(i == 1)
     {
               
      document.getElementById("payment").style.display = 'block';
      document.getElementById("subs_option").style.display == 'block';
      document.getElementById("conf_purchase").style.display == 'none';
     }
     if(i == 0)
     {
      document.getElementById("conf_purchase").style.display == 'block';
      document.getElementById("subs_option").style.display == 'none';
     } */
     
     if(i == 1)
     {
       if (document.getElementById("payment").style.display == 'block') {
           document.getElementById("payment").style.display = 'none';
       }
       else{
           document.getElementById("payment").style.display = 'block';
           document.getElementById("subs_option").style.display = 'block';
           document.getElementById("conf_purchase").style.display = 'none';

       }
       
       
       if (document.getElementById("payment_lean_overlay").style.display == 'block') {
           document.getElementById("payment_lean_overlay").style.display = 'none';
       }else{
           document.getElementById("payment_lean_overlay").style.display = 'block';
       } 
     }
     
     if(i == 0)
     {
       if (document.getElementById("payment").style.display == 'block') {
           document.getElementById("payment").style.display = 'none';
       }
       else{
           document.getElementById("payment").style.display = 'block';
           document.getElementById("subs_option").style.display = 'none';
           document.getElementById("conf_purchase").style.display = 'block';

       }
       
       
       if (document.getElementById("payment_lean_overlay").style.display == 'block') {
           document.getElementById("payment_lean_overlay").style.display = 'none';
       }else{
           document.getElementById("payment_lean_overlay").style.display = 'block';
       } 
     }
}
</script> 
<script>
function showfixdiv(){
     
    
       if (document.getElementById("payment").style.display == 'block') {
           document.getElementById("payment").style.display = 'none';
       }
       else{
           document.getElementById("payment").style.display = 'block';
           document.getElementById("subs_option").style.display = 'none';
           document.getElementById("conf_purchase").style.display = 'block';

       }
       
       
       if (document.getElementById("payment_lean_overlay").style.display == 'block') {
           document.getElementById("payment_lean_overlay").style.display = 'none';
       }else{
           document.getElementById("payment_lean_overlay").style.display = 'block';
       } 
     
     
     
}
</script> 
<script type="text/javascript">
  $(document).ready(function () {
    $('.sub_modal_close').click(function() {
        $("#payment").hide();     
        $("#payment_lean_overlay").hide();      
        
     });
});
</script> 
<script type="text/javascript">

//   $(document).ready(function () {
//     $('.enroll_modal_close').click(function() {
//         $("#enroll").hide();      
//         $("#enroll_lean_overlay").hide();     
        
//      });
// });
function close_enroll(){
        $("#enroll").hide();      
        $("#enroll_lean_overlay").hide(); 
}
</script> 
<script type="text/javascript">
  $(document).ready(function () {
    $('.preview_modal_close').click(function() {
        $("#preview").hide();     
        $("#preview_lean_overlay").hide();      
        
     });
});
</script> 
<script type="text/javascript">
  $(document).ready(function () {
    
        $("#status").show();      
        $("#status_lean_overlay").show();     
        
     
});
</script> 
<script type="text/javascript">
  $(document).ready(function () {
    $('.status_modal_close').click(function() {
        $("#status").hide();      
        $("#status_lean_overlay").hide();     
        
     });
});
</script> 

<!--Enroll Pop-up-->
<div id="enroll"  style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 100px;">
  <div id="payment-ct">
    <?php $attributes = array('class' => 'tform', 'id' => '');
   echo form_open_multipart(base_url().'programs/enroll/'.$programs->id, $attributes); ?>
    <h3 class="general-heading">Enroll</h3>
    <a class="enroll_modal_close" href="#" onclick="close_enroll()"><i class="entypo-cancel-squared"></i></a>
    <div class="pay_main_cont">
      <div class="tab-content">
        <p>Do You Want to Enroll?</p>
        <input class="btn-primary_red" type="submit" name="" value="Enroll Now" />
      </div>
    </div>
    <?php echo form_close();  ?> </div>
</div>

<div id="enroll_lean_overlay" style="display: none; opacity: 0.5;"> </div>
<script>
  function showEnrolldiv()
  {
    if (document.getElementById("enroll").style.display == 'block') {
               document.getElementById("enroll").style.display = 'none'
       }else{
               document.getElementById("enroll").style.display = 'block'
       }
     
     if (document.getElementById("enroll_lean_overlay").style.display == 'block') {
               document.getElementById("enroll_lean_overlay").style.display = 'none'
       }else{
               document.getElementById("enroll_lean_overlay").style.display = 'block'
       }
  
  }

</script> 

<!--Preview Pop-up-->
<div id="preview"  style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 100px;">
  <div id="payment-ct">
    <?php $attributes = array('class' => 'tform', 'id' => '');
    echo form_open_multipart(base_url().'programs/enroll/'.$programs->id, $attributes); ?>
    <h3 class="general-heading">Preview</h3>
    <a class="preview_modal_close" href="#"><i class="entypo-cancel-squared"></i></a>
    <div class="pay_main_cont">
      <div class="tab-content">
        <?php
        $db_media = $this->program_model->getMedia_oflayout('mod_m',123);
      ?>
        <iframe src="<?php echo base_url();?>medias/ajaxmediaview/<?php echo $db_media[0]->media_id;?>/1"  ></iframe>
      </div>
    </div>
    <?php echo form_close();  ?> </div>
</div>
<div id="preview_lean_overlay" style="display: none; opacity: 0.5;"> </div>


<div id="cta-sticky">
  <div class="stick-left">
 <ul class="stick-menu">
  <li data-id="1"><a href="#course" target="_self">About This Course</a></li>
    <li data-id="2"><a href="#curriculum" target="_self">Curriculum</a></li>
    <!--<li><a href="" target="_self">Instructor</a></li>-->
    <li data-id="3"><a href="#reviews" target="_self">Reviews</a></li>
 </ul>
    </div> 
          <div class="course-price-box course-price-box1">
                
                <?php
     //echo"<pre>";
     //print_r($default_plans);
    // print_r($programs);
  if(intval($programs->fixedrate) == 0 && ($default_plans['0']['default_new']) == 1)
  {
    if(empty($user_id))
    {
    ?>
        <div >
        <p class="course-price-text">Price :<span>
    <?php 
      if(($default_plans['0']['default_new']) == 1) 
      {
        echo $currency_symbol.$default_plans['0']['price']." / <span style='color: #54b551;font-size: 16px;font-weight: 600;'>".$default_plans['0']['term']." ".$default_plans['0']['period']."</span>"; 
      }
      else 
      {
        echo "FREE";
      }
    ?></span> 

    </p>
    <!--<p><a id="go" rel="leanModal" name="signup" href="#subs"  onclick="showsubsdiv()">Subscriptions Options</a></p>-->
        <a class="btn-take-course" id="go" rel="leanModal" name="signup" href="#signup" style="margin:margin: 7px 0 0 10px;"><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i><?php if(($default_plans['0']['default_new']) == 1) { echo $btn_msg; } else { echo $btn_msg; } ?></a>
        </div>
        
        <?php
      }
    else
    {
    ?>
        <div>
        <p class="course-price-text">Price :<span>
        <?php if($assigned) { echo 'FREE'; } 
        else if(($default_plans['0']['default_new']) == 1) { echo $currency_symbol.$default_plans['0']['price']." / <span style='color: #54b551;font-size: 16px;font-weight: 600; text-transform: none;'>".$default_plans['0']['term']." ".$default_plans['0']['period']."</span>"; } else { echo "FREE"; } ?></span> </p>
    <!--<p><a id="go" rel="leanModal" name="signup" href="#signup"  onclick="showsubsdiv()">Subscriptions Options</a></p>-->
        <a  
    <?php  
      if(($default_plans['0']['default_new']) == 1)
      {
        if($isEnrolled > 0 && $curr_date < $exp_date)
        {
          // echo "href=".base_url()."programs/lectures/".$programs->id;
          echo "href=".base_url().$urlCourse."/lectures/".$programs->id;
        }
        else
        {
          echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showdiv(".$subscription.")'";
        }
      }
    
    ?> class="btn-take-course"><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i><?php if(($default_plans['0']['default_new']) == 1) { echo $btn_msg; } else { echo $btn_msg; } ?></a>
        <?php
        }
      } 
    else
    {
        ?>
        </div>
        
      <div class="course-price-box">
            <p class="alr-subs"><?php echo $showalready; ?></p>
      <p class="course-price-text">Price :<span><?php  if($assigned) { echo 'FREE'; } else if(intval($programs->fixedrate) > 0) { echo $currency_symbol.$programs->fixedrate;} else { echo "FREE";} ?></span> 
            
            <?php
      if(empty($user_id))
      {
      ?>
      <!--<a class="btn-primary_sub fancybox fancybox.iframe" href="<?php echo base_url();?>programs/payment/<?php echo $programs->id?>"  style="margin-left: -15px; margin-right: -15px"><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i>Take This Course</a>--> 
      <a class="btn-take-course" id="go" rel="leanModal" name="signup" href="#signup"><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i><?php if(intval($programs->fixedrate) > 0) { echo $btn_msg;} else { echo $btn_msg;} ?></a>
      <?php
      }
      else
      {
        ?>
        <a class="btn-take-course" 
        <?php 
        if($assigned)
        {
          if($isEnrolled > 0)
          {
            // echo "href=".base_url()."programs/lectures/".$programs->id;
            echo "href=".base_url().$urlCourse."/lectures/".$programs->id;
          }
          else
          {
            echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showEnrolldiv()'";
          }
        }

        else if(intval($programs->fixedrate) > 0)
        {
          //if($isEnrolled > 0 && $curr_date < $exp_date)
          if($isEnrolled > 0 && $getBuyCoursesUser->plan_id==0)
          {
            // echo "href=".base_url()."programs/lectures/".$programs->id;
            if($block_enrolled == 0)
              { 
             echo "href=".base_url().$urlCourse."/lectures/".$programs->id;
              }
              else
              {
                echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showfixdiv()'";
              }
          }
          else
          {
            echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showfixdiv()'";
          }
        }
        else
        {
          if($isEnrolled > 0)
          {
            if($block_enrolled == 0)
            { 
            // echo "href=".base_url()."programs/lectures/".$programs->id;
            echo "href=".base_url().$urlCourse."/lectures/".$programs->id;
            }
              else
              {
                echo"onclick= 'showmsg()'";
              }
          }
          else
          {
            echo "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."href='#signup'".' '."onclick='showEnrolldiv()'";
          }
        }
        ?>>
          <i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i><?php if(intval($programs->fixedrate) > 0) { echo $btn_msg;} else { echo $btn_msg;} ?></a> <!--href="<?php echo base_url();?>paypal/index/<?php echo $programs->id?>"-->
        <?php   
      }
      }
    ?>
            
            </p>
      
            
      
          </div>
        
        </div>
</div>
<script>
  function showPreviewdiv()
  {
    if (document.getElementById("preview").style.display == 'block') {
               document.getElementById("preview").style.display = 'none'
       }else{
               document.getElementById("preview").style.display = 'block'
       }
     
     if (document.getElementById("preview_lean_overlay").style.display == 'block') {
               document.getElementById("preview_lean_overlay").style.display = 'none'
       }else{
               document.getElementById("preview_lean_overlay").style.display = 'block'
       }
  
  }

</script> 

<!--lightbox scripts and style  --> 

<!--<script type="text/javascript" src="<?php //echo base_url(); ?>/public/js/jquery-1.9.0.min.js"></script>--> 
<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox2.css?v=2.1.4" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script> 
<script type="text/javascript">
    $(document).ready(function() 
    {
    $('.fancybox').fancybox();
      /*
       *  Simple image gallery. Uses default settings
       */

      $('.fancybox').fancybox();
      /*
       *  Different effects
       */
      // Change title type, overlay closing speed
      $(".fancybox-effects-a").fancybox({
        helpers: {
          title : {
            type : 'outside'
          },
          overlay : {
            speedOut : 0
          }
        }
      });
      // Disable opening and closing animations, change title type
      $(".fancybox-effects-b").fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        helpers : {
          title : {
            type : 'over'
          }
        }
      });

      // Set custom style, close if clicked, change title type and overlay color

      $(".fancybox-effects-c").fancybox({

        wrapCSS    : 'fancybox-custom',

        closeClick : true,

        openEffect : 'none',

        helpers : {

          title : {

            type : 'inside'

          },

          overlay : {

            css : {

              'background' : 'rgba(238,238,238,0.85)'

            }

          }

        }

      });


      // Remove padding, set opening and closing animations, close if clicked and disable overlay

      $(".fancybox-effects-d").fancybox({

        padding: 0,

        openEffect : 'elastic',

        openSpeed  : 150,

        closeEffect : 'elastic',

        closeSpeed  : 150,

        closeClick : true,

        helpers : {

          overlay : null

        }

      });

      /*

       *  Button helper. Disable animations, hide close button, change title type and content

       */

      $('.fancybox-buttons').fancybox({

        openEffect  : 'none',

        closeEffect : 'none',

        prevEffect : 'none',

        nextEffect : 'none',

        closeBtn  : false,

        helpers : {

          title : {

            type : 'inside'

          },

          buttons : {}

        },

        afterLoad : function() {

          this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');

        }

      });

      /*

       *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked

       */

      $('.fancybox-thumbs').fancybox({

        prevEffect : 'none',

        nextEffect : 'none',

        closeBtn  : false,

        arrows    : false,

        nextClick : true,

        helpers : {

          thumbs : {

            width  : 50,

            height : 50

          }

        }

      });

      /*

       *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.

      */

      $('.fancybox-media')

        .attr('rel', 'media-gallery')

        .fancybox({

          openEffect : 'none',

          closeEffect : 'none',

          prevEffect : 'none',

          nextEffect : 'none',

          arrows : false,

          helpers : {

            media : {},

            buttons : {}

          }

        });

      /*

       *  Open manually

       */

      $("#fancybox-manual-a").click(function() {

        $.fancybox.open('1_b.jpg');

      });

      $("#fancybox-manual-b").click(function() {

        $.fancybox.open({

          href : 'iframe.html',

          type : 'iframe',        

          padding : 5

        });

      });


      $("#fancybox-manual-c").click(function() {

        $.fancybox.open([

          {

            href : '1_b.jpg',

            title : 'My title'

          }, {

            href : '2_b.jpg',

            title : '2nd title'

          }, {

            href : '3_b.jpg'

          }

        ], {

          helpers : {

            thumbs : {

              width: 75,

              height: 50

            }

          }

        });

      });
    });
  </script> 
  
  
  <script type="text/javascript">
      

    $.fn.stars = function() {
      return $(this).each(function() {
        $(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).html())))) * 16));
      });
    }
  </script>

<script>
  function showmsg()
  {
    alert('your Enrollment is Block');
  }
  </script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
<script src="<?php echo base_url() ?>public/Creating-Collapsible-Table-Rows/jquery.aCollapTable.js"></script>
  <script>
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
$j(document).ready(function(){
$j('.collaptable').aCollapTable({

  startCollapsed: true,
  //addColumn: false, 
  //plusButton: '<span class="i">more</span>',

  //minusButton: '<span class="i">-</span>'

});
});

$j(document).ready(function(){
$j('.act-button-expand-all').click(function()
        { 
          //alert('yes');
            $(this).hide();
        });
});
</script>
  
<!--<script>
/*function showdiv()
{
  document.getElementById('payment').style.display = 'block';
}*/
 function showsubsdiv(){
       if (document.getElementById("subs").style.display == 'block') {
               document.getElementById("subs").style.display = 'none'
       }else{
               document.getElementById("subs").style.display = 'block'
       }
     
     if (document.getElementById("subs_lean_overlay").style.display == 'block') {
               document.getElementById("subs_lean_overlay").style.display = 'none'
       }else{
               document.getElementById("subs_lean_overlay").style.display = 'block'
       }
}
</script>--> 
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
    <script>
       var $j = jQuery.noConflict();
      $j(document).ready(function(){
        //Examples of how to assign the Colorbox event to elements
        
        //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});     
      $j(".iframe").colorbox({
        iframe:true,
        width:"600px", 
        height:"400px",
        fadeOut:500,
        fixed:true,
        reposition:true,                  
            })
      
      });
    </script>

    <script>
 
	function ajax_addwishlist(pro_id,hover_id)
	{
	   
        var  dataString1 = pro_id;
        var  dataString2 = hover_id;
			
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/programs/addwishlist",
            data    : {'pro_id':dataString1,'hover_id':dataString2},
 
           success: function(data){
              
			  $("#wishheart"+hover_id).html(data); 
           }
 
         });
 
       
 
      }
 
	function ajax_deletewishlist(pro_id,wishlist_id,hover_id)
	{
	   
        var  dataString1 = wishlist_id;
        var  dataString2 = hover_id;
        var  dataString3 = pro_id;
			
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/programs/deletewishlist",
            data    : {'wishlist_id':dataString1,'hover_id':dataString2,'pro_id':dataString3},
 
           success: function(data){
              
			  $("#wishheart"+hover_id).html(data); 
           }
 
         });
 
        
 
      }


  function show_wishheart(idd)
	{
	       if(document.getElementById(idd).id  == idd)
	       {
	               document.getElementById('wishheart'+idd).style.display = "block";
	               //document.getElementById('wishheart').style.visibility = 'visible';
	       }
	}

function hide_wishheart(idd)
{
       if(document.getElementById(idd).id  == idd)
       {
               document.getElementById('wishheart'+idd).style.display = "none";
       }
}
</script>