<?php $this->load->view('new_template_design/header'); ?>

<style type="text/css">
	.row.container .inputs{
		width: 100%;
		background: transparent;
		border: 0px;
		font-size: 13px;
		border-bottom: 1px solid #cbcac9;
		padding: 8px;
		margin-bottom: 10px;
		transition: 0.3s all ease;
	}
	.row.container .col-sm-4{
	    padding-top: 50px;
	    padding-bottom: 50px;
	}
	.row.container{
	    padding-top: 20px;
	    padding-bottom: 20px;
	}
</style>

<div class="row container">
	<div class="col-sm-8"></div>
	<div class="col-sm-4">
		<input type="text" class="inputs" id="full_name" placeholder="Full Name*">
		<input type="text" class="inputs" id="email" placeholder="Email ID*">
		<input type="text" class="inputs" id="contact_no" placeholder="Contact No.*">

	</div>
</div>

<?php $this->load->view('new_template_design/footer'); ?>