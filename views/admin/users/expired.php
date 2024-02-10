<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script src="http://itacademy.createonlineacademy.com/public/default/js/jquery-1.7.1.min.js" type="text/javascript" ></script>
    <script src="http://itacademy.createonlineacademy.com/public/default/js/jquery-ui-1.8.21.custom.min.js" type="text/javascript" defer ></script>    
    <script src="http://itacademy.createonlineacademy.com/public/classic/js/jquery.min.js" type="text/javascript" defer ></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="http://itacademy.createonlineacademy.com/public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="http://itacademy.createonlineacademy.com/public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script type="text/javascript">

  jQuery(document).ready(function()
    {
       deleteconfirm();
    });

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
function deleteconfirm() 
       {
                   
                       $j.alert({
                            theme: 'supervan',
                           confirmButtonClass: 'btn btn-info',
                           cancelButtonClass: 'btn btn-danger',
                           title: 'Website has been expired.',
                           content: 'It appears that a local network filter has blocked access to the page that you were trying to visit.  If you believe that you should have access to that page, please contact the relevant network personnel.',
                           confirm: function(){
                                                 window.location.href = "<?php echo base_url(); ?>";
                                            }
                                         });
                       //}
               }
    </script>