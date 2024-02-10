<?php $CI =& get_instance();
  $CI->load->model('admin/settings_model');
  $allsociallinks=$CI->settings_model->getSocialLinks();
  $getItemssetting = $CI->settings_model->getItems();
  $auth = $this->session->userdata('logged_in');
  $logoimage=$getItemssetting[0]['logoimage'];?>
<style type="text/css" media="all">
body {
  margin: 0;
}
#m_main {
  padding: 0px;
}
p {
  margin: 0 0 5px 0;
}
a {
  color: #F03A3B; text-decoration: none;
}


</style>
<div id="m_main">
    <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#F1F1F1" style="border-bottom: 0px solid #E0E0E0;">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" style="max-width: 580px; font-size: 14px; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; width: 100%; color: #353535;">
                            <tr>
                                <td style="padding: 10px 0;"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $logoimage;?>" alt="Academy logo" border="0" width="250" height="80"/></a></td>
                            </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" style="max-width: 580px; font-size: 14px; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; width: 100%; color: #353535;" bgcolor="#fff">
                    <tr>
                        <td style="padding: 20px 10px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
<?php echo $content;?>
                                </td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#F1F1F1" style="border-top: 1px solid #E0E0E0;">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" style="max-width: 580px; font-size: 14px; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; width: 100%; color: #353535;">
                    <tr>
                        <td style="padding: 30px; border-bottom: 1px solid #282D32;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><!--<a href="#" style="color: #282D32">BLOG</a>--></td>
                                <td>Powered by   <a href="http://createonlineacademy.com"><img src="<?php echo base_url();?>public/uploads/settings/img/logo/COAlogo.png" alt="Create Online Academy" border="0" height ="18" /></a></td>
                                <td><!--<a href="#" style="color: #282D32">FACEBOOK</a>--></td>
                                <td><!--<a href="#" style="color: #282D32">TWITTER</a>--></td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
                <!--<div style="max-width: 580px; font-size: 12px; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; width: 100%; color: #757575;">
                <p>&nbsp;</p>
<p>This message was sent to yourmailid@gmail.com</p>
<p>&copy; MLMS, All Rights Reserved.</p>
<p><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
                <p>&nbsp;</p>
                </div>-->
            </td>
        </tr>
    </table>
</div>