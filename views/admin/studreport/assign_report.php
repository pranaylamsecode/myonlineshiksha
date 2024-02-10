<div class="final_submit_txt">
	<div>
		<center><h3>Student Assignment Details</h3></center>
		<?php $i = 1;
		foreach ($assignment_log as $key) {
			$getques = $this->Crud_model->get_single('mlms_assign_que',"q_id = ".$key->que_id);
		?>
		<div>
	 		<span><b style="font-size: 16px">Q. <?php echo $i++?>)</b> </span><?php echo $getques->que_text; ?>
	 		<span><b style="font-size: 16px">Submitted Answer : </b></span><?php echo $key->answer; ?>
	 		<?php if (!empty($key->ans_attach)) { ?>
	 		<p><b style="font-size: 16px;color: black">Attachments : </b>
	 			<a style="font-size: 15px" href="<?php echo base_url()."public/uploads/assignments/stud_answer/".$key->ans_attach; ?>" target="_blank">view answer File</a>
	 		</p>
	 		<?php } ?>
	 	</div>
	 	<br>

	 	<div class="row">
	 		<div class="col-sm-8">
		 		<p><b>Remark : </b><span id="err_<?php echo $key->id;?>"></span></p>
		 		<textarea class="description" id="remark_<?php echo $key->id;?>"><?php if(!empty($key->remark)){ echo $key->remark;} ?></textarea>
	 		</div>
	 		<div class="col-sm-4">
		 		<p><b>Attach Feedback file : </b><span id="uploaderr_<?php echo $key->id;?>"></span></p>
		 		<input type="file" id="remark_attach_<?php echo $key->id;?>">
		 		<div class="col-sm-6 form-group" style="padding-top: 15px;">
		 			<?php if(!empty($key->remark_attach)){ ?>
		 			<a href="<?php echo base_url().'public/uploads/assignments/remarks/'.$key->remark_attach; ?>" target="_blank">view Attachment</a>
		 			<?php } ?>
		 		</div>
		 		<div class="col-sm-6 form-group" style="padding-top: 15px;">
  					<button class="btn btn-success form-control" id="btn_remark_<?php echo $key->id;?>" onclick="return send_remark(<?php echo $key->id;?>)">Send Remark</button>
  					<button id="ans_div_<?php echo $key->id;?>" class="btn btn-success form-control" style="display: none;">
						<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please Wait...
					</button>
  				</div>
  				<div class="col-sm-12 col-xs-12" style="padding-top: 30px">
		            <span id="message_<?php echo $key->id;?>"></span>
		         </div>
	 		</div>
	 	</div>
	 	<hr>
	 	<?php } ?>
	</div>
</div>
<div style="padding-bottom: 55px;"></div>

<script src='<?php echo base_url() ?>public/js/tinymce/tinymce.min.js'></script>

<script type="text/javascript">
	function send_remark(id)
	{
		var id = id;
		var remark = tinyMCE.get('remark_'+id).getContent();
		if(remark == ''){
			$("#err_"+id).html('Please write your Remark.');
	    	tinyMCE.get('remark_'+id).focus();
			setTimeout(function(){$("#err_"+id).html('');},2000);
			return false;
		}else{
			$("#btn_remark_"+id).css('display','none');
			$("#ans_div_"+id).css('display','block');
			var remark_attach = $("#remark_attach_"+id)[0].files[0];
			var new_formdata= new FormData();
			new_formdata.append('remark',remark);
			new_formdata.append('remark_attach',remark_attach);
			new_formdata.append('id',id);
			$.ajax({
				type : "post",
				cache : false,
				processData: false,
    			contentType: false,
				url : "<?php echo base_url();?>admin/studreport/send_remark/",
				data : new_formdata,
				success : function(response)
				{
					console.log(response);
					$("#btn_remark_"+id).css('display','block');
					$("#ans_div_"+id).css('display','none');
					if(response == 0){
						$("#uploaderr_"+id).html(' The filetype you are attempting to upload is not allowed.');
						$("#remark_attach_"+id).val('');
						setTimeout(function(){$("#uploaderr_"+id).html('');},2500);
					}else{
						$("#message_"+id).html('<div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true"> </i> </a> <strong class="fa fa-check" aria-hidden="true"> '+response+' </strong></div>').fadeIn().delay(2000).fadeOut();

					}
				}
			});
		}
	}

	jQuery(document).ready(function(){
      tinymce.init({
  		selector: '.description',
 		height: 150,
 		// min_width: 400,
 		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen" ],
		toolbar: "eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
		image_title: true,
		automatic_uploads: true,
		images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
		file_picker_types: 'image',
		image_advtab: true,
		file_picker_callback: function(callback, value, meta) {
		      if (meta.filetype == 'image') {
		        $('#upload').trigger('click');
		        $('#upload').on('change', function() {
		          var file = this.files[0];
		          var reader = new FileReader();
		          reader.onload = function(e) {
		            callback(e.target.result, {
		              alt: ''
		            });
		          };
		          reader.readAsDataURL(file);
		        });
		      }
		    },
 		});
    });
</script>