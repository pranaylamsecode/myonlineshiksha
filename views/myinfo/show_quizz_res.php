<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/default/css/style.css" />
<div id="all">
<div id="main">
<div id="system-message-container">
       <a onclick="window.history.go(-1)" href="javascript:void(0);" class="button">back</a>
</div>
<?php
$this->load->helper('quizcertificate');
$programdetail = '';

$view = 'result';
certificate_view($quiz_id,15,'',$pid,$view);

?>
</div>
</div>