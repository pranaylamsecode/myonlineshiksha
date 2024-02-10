<style type="text/css">
	@keyframes blink {50% { color: transparent }}
.loader__dot { animation: 1s blink infinite; font-size: 22px;font-weight: bold; }
.loader__dot:nth-child(2) { animation-delay: 250ms; font-size: 22px;font-weight: bold; }
.loader__dot:nth-child(3) { animation-delay: 500ms; font-size: 22px;font-weight: bold; }
.coursess{
	padding-bottom: 95px !important;
	padding-top: 95px !important;
}
</style>
<section class="container coursess">
	<div class="row text-center">
		<img  alt="Thank You" src="<?php echo base_url(); ?>/public/uploads/settings/if_circle-check_Green.png" width="110px">
	</div>
	<div class="row text-center">
		<h3>Thanks!</h3>
		<?php 
		$data = $this->session->userdata('nr');
		if(!empty($data)){
			$url =  substr($data,intval(strpos($data, "lectures/"))+intval(9));
			$course = $this->Crud_model->get_single('mlms_program',"id = ".$url,"name");
		?>
		<p>for Buying <span style="font-weight: 700; font-size: 20px;">"<?php echo ucwords($course->name); ?>"</span> course. You'll be redirected to Lectures shortly.</p>
		<?php } ?>
		<p style="font-size: 20px;">Please wait <span class="loader__dot">.</span><span class="loader__dot">.</span><span class="loader__dot">.</span>
		</p>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function () {
			window.location.href = "<?php echo $this->session->userdata('nr');?>";
    }, 2000);
});
</script>