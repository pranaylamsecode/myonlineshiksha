
<style>
.thx_msg{
	text-align: center;
    /*position: absolute;
    width: 100%;
    top: 25%;
    transform: translateY(-50%);*/
    min-height: 300px;
}
footer.container-fluid {
    /*position: absolute !important;
    bottom: 0px;
    width: 100%;
    padding-top: 20px !important;*/
}
h3, h4{
    padding-top: 15px;
}
h3 i.fa-pulse, h4 i.fa-pulse{
    margin-left: 10px;
}
.lastchild{
    padding-top: 30px;
}
@media (max-width:767px){
    .thx_msg {
        text-align: center;
        position: unset;
        width: 100%;
        top: 0px;
        transform: unset;
        padding: 40px 15px;
    }
    .thx_msg h2 {
        margin: 0px;
        font-size: 18px;
        line-height: 1.4em;
    }
    footer.container-fluid {
        /*position: unset !important;
        bottom: 0px;
        width: 100%;
        padding-top: 20px !important;*/
    }
}

</style>
 <div class="thx_msg">
    <?php $page = $this->session->userdata('page');
    $this->session->unset_userdata('page');
    if($page != ''){ ?>
    <h4 class="lastchild">Thank you for enrolling to the <?php echo ucwords($page);?> Industry Readiness Program with TCS iON remote internship. </h4>

    <h4>We will send instructions with the information to start accessing the content to your registered email.</h4>

    <h4>For any query, you can contact Mr.Ashish at +91-9960912357.</h4>
    <!-- <h4 class="lastchild">Please wait <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></h4> -->
    <a class="btn btn-success" href="<?php echo base_url().$lasturl;?>" style="margin-top: 30px;font-size: 16px;font-weight: 501;background-color: #00a504;">Back to Course</a>
    <?php }else{ ?>
 	<h2 class="lastchild">Thanks for connecting with us, Your request has been submitted!</h2>
    <h3 class="lastchild">Please wait <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></h3>
    <?php } ?>
 </div>
 <?php if($page == ''){ ?>
 <script type="text/javascript">
     $(document).ready(function(){
        /*var ttmm = $("#ttmm").val().trim();*/
        setTimeout(function(){
            window.location.href = "<?php echo $lasturl;?>";
            var a = "<?php $this->session->unset_userdata('lasturl');?>";
        },3000);
     }); 
 </script>
 <?php } ?>