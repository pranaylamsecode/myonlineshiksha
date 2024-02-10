<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
<style type="text/css">
  .btn.btn-default {
      border: 1px solid #f0f0f1;
      background: #f0f0f1;
      margin-left: 10px;
  }
  .content.cources_main_content {
      padding: 50px;
  }
</style>
<div class="page-container myinfo_page">
  <div class="main-content">
    <div class="info_page_breadcrumb">
      <div class="info_container">
        <h3>TCS iON Remote Internship Program</h3>
        <!-- <p>
        </p> -->
      </div>
    </div>
    <div class="content cources_main_content">
      <div class="info_container">  
        <div class="my_course_section">  
          <p style="font-size: 18px;">Your TCS iON Remote Internship Activation Code : </p>
          <b style="font-size: 22px;"></b>
          <?php if(!empty($tcs_orders)){ ?>
          <input value="<?php echo $tcs_orders->activation_code;?>" type="text" id="share_link" style="background: #fff;border: #fff;font-size: 22px;padding: 0px !important;font-weight: 501" readonly="">
          <button class="btn btn-default" id="copybtn">copy code</button>
          <?php } ?>
          <p style="font-size: 18px;padding-top: 25px;">Go to <a href="https://learning.tcsionhub.in/hub/rio/" target="_blank" style="font-style: italic;font-weight: 501;padding: 0 5px;">https://learning.tcsionhub.in/hub/rio/</a> Click on the Activate Now button</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  document.getElementById("copybtn").addEventListener("click", function(){
    var copyText = document.getElementById("share_link");
    copyText.select();
    document.execCommand("Copy");
  });
</script>