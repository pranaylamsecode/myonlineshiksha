<?php $CI =& get_instance();
  $CI->load->model('admin/settings_model');
  $allsociallinks=$CI->settings_model->getSocialLinks();
  $getItemssetting = $CI->settings_model->getItems();
  $auth = $this->session->userdata('logged_in');
  $logoimage=$getItemssetting[0]['logoimage'];
  $bannerimage=$getItemssetting[0]['bannerimage'];
  $institute_name=$getItemssetting[0]['institute_name'];
  $social_url=$getItemssetting[0]['socialbuttons'];
  $socialAsArray = json_decode($social_url, TRUE);
  // $fromemail = $getItemssetting[0]['fromemail'];
  $fromemail = "support@myonlineshiksha.com";
   
//print_r($socialAsArray);
$facebook_url = $socialAsArray[0]['siteurl'];
$twitter_url = $socialAsArray[1]['siteurl'];
$linkedin_url = $socialAsArray[2]['siteurl'];
$youtube_url = $socialAsArray[3]['siteurl'];
 
   //print_r($getItemssetting);

  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <style type="text/css">
        .two-column {
            text-align: center;
            font-size: 0;
        }
        
        .two-column .column {
            width: 100%;
            max-width: 300px;
            display: inline-block;
            vertical-align: top;
        }
        
        .contents {
            width: 100%;
        }
        
        .two-column .contents {
            font-size: 14px;
            text-align: left;
        }
        
        .two-column img {
            width: 100%;
            max-width: 280px;
            height: auto;
        }
        
        .two-column .text {
            padding-top: 10px;
        }
        
        .three-column {
            text-align: center;
            font-size: 0;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        
        .three-column .column {
            width: 100%;
            max-width: 200px;
            display: inline-block;
            vertical-align: top;
        }
        
        .three-column img {
            width: 100%;
            max-width: 180px;
            height: auto;
        }
        
        .img-align-vertical img {
            display: inline-block;
            vertical-align: middle;
        }
    </style>
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
        table {border-collapse: collapse !important;}
    </style>
    <![endif]-->
</head>


<body style="Margin:0; padding-top:0; padding-bottom:0; padding-right:0; padding-left:0; min-width:100%; background-color:#ebebeb; margin: 0; padding: 0; min-width: 100%; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; mso-line-height-rule: exactly">
    <center style="width:100%; table-layout:fixed; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; background-color:#ebebeb; width: 100%; table-layout: fixed; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#ebebeb" bgcolor="#ebebeb">
            <tr>
                <td width="100%">
                    <div style="max-width:600px; margin:0 auto">

                        <!--[if (gte mso 9)|(IE)]>

                        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0;font-family: Calibri, sans-serif;color:#333333;" >
                            <tr>
                                <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                                <![endif]-->

                        <!-- ======= start main body ======= -->
                        <table class="outer" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0; font-family: Arial, sans-serif; color:#696e78; Margin:0 auto; width:100%; max-width:600px; background-color: #ebebeb" bgcolor="#ebebeb">
                            <tr>
                                <td style="padding-top:0; padding-bottom:0; padding-right:0; padding-left:0">
                                    <!-- ======= start Header ======= -->
                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="background-color: #ffffff">
                                        <tr>
                                            <td style="background-color: #ffffff" bgcolor="#ffffff">
                                                <table style="width: 100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <center>
                                                                    <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="one-column" style="padding-top:0; padding-bottom:0; padding-right:0; padding-left:0">
                                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0; font-family: Arial, sans-serif; color:#333333">
                                                                                        <tr>
                                                                                            <td style="width:100%; display:none !important;visibility: hidden; mso-hide:all;font-size:1px; color:#41414b; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden">
                                                                                              <!--   Introducing the New MCUW Networking Community -->
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- ======= end Header ======= -->






                                    <!-- ======= start Hero Area ======= -->
                                    <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0; background-color: #ffffff" bgcolor="#ffffff">
                                        <tr>
                                            <!-- ======= logo ======= -->
                                            <td align="center" style="padding-top: 20px; padding-bottom: 20px">
                                                <a href="<?php echo base_url(); ?>" style="display: block; border: 0px !important;"><img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $logoimage;?>" alt="Academy logo" width="209px" border="0" style="display: block;"/></a>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- ======= end Hero Area ======= -->





                                    <!-- ======= start Divider ======= -->
                                    <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0; background-color: #ffffff;" bgcolor="#ffffff">
                                        <tr>
                                            <td align="center" style="padding-top: 10px; padding-bottom: 10px">
                                                <table border="0" cellpadding="0" cellspacing="0" width="93%" style="border-spacing:0">
                                                    <tr>
                                                        <td align="center" style="border-bottom: 1px solid #ebebeb; font-size: 0px">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- ======= end Divider ======= -->






                                    <!-- ======= start Single Column ======= -->
                                    <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0; background-color: #ffffff" bgcolor="#ffffff">
                                        <tr>
                                            <td align="center" style="padding: 20px">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                   <!--  <tr>
                                                        <td align="center">
                                                            <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $bannerimage;?>" width="100%" style="border-radius: 3px; -webkit-border-radius: 3px; border: 0; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; color: #222222; font-size: 26px; max-width:560px;" alt="" />
                                                        </td>
                                                    </tr> -->
                                                    <tr>
                                                        <td style="font-family: 'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, AppleGothic, sans-serif; color: #222222; font-size: 14px; letter-spacing: 1px; line-height: 20px; /*padding-top: 20px*/" align="left">
                                                            <!-- <span style="font-size: 18px; font-weight: bold; text-transform: uppercase">Subscription About To Expire</span>
                                                            <br /> -->
                                                            <?php echo $content;?>
                                                        </td>
                                                    </tr>
                                               
                                                            </table>
                                                            <!-- END BUTTON -->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- ======= end Single Column ======= -->


                                    <!-- ======= start Offer Single Column ======= -->
                                    <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0; background-color: #ffffff;" bgcolor="#ffffff">
                                        <tr>
                                            <td align="center" style="padding: 20px">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="center" style="letter-spacing: 1px; font-size: 20px; color: #222222; font-family: 'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, AppleGothic, sans-serif; border-bottom: 1px solid #ebebeb; border-top: 1px solid #ebebeb; padding-bottom: 15px; padding-top: 15px">
                                                            ONLINE SUPPORT
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="letter-spacing: 1px; line-height: 20px; font-size: 14px; color: #222222; font-family: 'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, AppleGothic, sans-serif; padding-top: 20px">
                                                         If you need help or have any questions, you can contact us at <a style="color: #55c5eb;" href="mailto:<?php echo $fromemail ?>" target="_blank"><?php echo $fromemail ?></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="padding-top: 20px">
                                                            <!-- START BUTTON -->
                                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                <tr>
                                                                    <td>
                                                                        <table border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0 auto">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center">
                                                                                        <table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto">
                                                                                            <tr>
                                                                                                <td height="30" align="center" style="padding-left: 15px; padding-right: 15px">
                                                                                                    <a href="<?php echo base_url();?>contact-us" style="display: block; text-decoration: none; border:0; text-align: center; font-weight: bold; font-size: 16px;
                                                                                                    font-family: 'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, AppleGothic, sans-serif; color: #55c5eb; line-height: 40px; letter-spacing: 1px">Contact Us</a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <!-- END BUTTON -->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- ======= end Offer Single Column ======= -->








                                    <!-- ======= start Divider ======= -->
                                    <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0; background-color: #ebebeb;" bgcolor="#ebebeb">
                                        <tr>
                                            <td align="center" style="font-size: 10px; line-height: 10px">
                                                &nbsp;
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- ======= end Divider ======= -->





                                    <!-- ======= start two column ======= -->
                                    
                                    <!-- ======= end two column ======= -->





                                    <!-- ======= start footer ======= -->
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ebebeb" style="background: #ebebeb">
                                        <tr>
                                            <td class="one-column" style="padding: 20px">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" style="padding-bottom: 20px; border-bottom: 1px solid #cccccc">
                                                                <table cellpadding="5" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td>
                                                                            <a href="http://<?php echo $facebook_url;?>" style="display: block; border: 0px !important;">
                                                                                <img border="0" style="display: block; width: 44px;" src="<?php echo base_url();?>public/css/image/SocialMedia-Facebook.png" alt="Facebook" />
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            <a href="http://<?php echo $twitter_url;?>" style="display: block; border: 0px !important;">
                                                                                <img border="0" style="display: block; width: 44px;" src="<?php echo base_url();?>public/css/image/SocialMedia-Twitter.png" alt="Twitter" />
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            <a href="http://<?php echo $youtube_url;?>" style="display: block; border: 0px !important;">
                                                                                <img border="0" style="display: block; width: 44px;" src="<?php echo base_url();?>public/css/image/youtube-icon1.png" alt="Instagram" />
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            <a href="http://<?php echo $linkedin_url;?>" style="display: block; border: 0px !important;">
                                                                                <img border="0" style="display: block; width: 44px;" src="<?php echo base_url();?>public/css/image/SocialMedia-LinkedIn.png" alt="LinkedIn" />
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:center; color: #000000; font-size:10px; line-height:12px; font-family: Arial, sans-serif; padding: 20px 10px 20px 10px">2016 <?php echo date('Y').' '.$institute_name ?> Ltd. In Mail are registered trademarks of <?php echo $institute_name ?> Corporation in the USA and/or other countries. All rights reserved.
                                                                <br />
                                                                <br />This is an occasional email to help you get the updates on <?php echo $institute_name ?>. <a href="http://www.example.com" style="color: #000000">Unsubscribe</a>
                                                                <br />If you have questions or need assistance, please contact the <?php echo $institute_name ?> team.
                                                                <br />
                                                                <br />
                                                                Powered by <a style="color: #55c5eb;" href="<?php echo base_url();?>"><?php echo $institute_name ?></a>
                                                               
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>
                                    <!-- ======= end footer ======= -->

                                </td>
                            </tr>
                        </table>
                        <!--[if (gte mso 9)|(IE)]>
                    </td>
                </tr>
            </table>
            <![endif]-->
                    </div>
                </td>
            </tr>
        </table>
    </center>

</body>

</html>