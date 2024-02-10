<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<script type="text/javascript">
$(function() {
	$('#file_i').live('change',function(e) {
	var ftpfilearray;
	e.preventDefault();
	$.ajaxFileUpload({
  		url :'<?php echo base_url(); ?>testimonials/upload_image/',
  		secureuri :false,
  		fileElementId :'file_i',
  		dataType : 'json',
      		data : {
      		    'type' : $('select#type').val()
      		},
      		success : function (data, status)
      		{
      			if(data.status != 'error')
      			{
          			$('#msgstatus_i').html('<p>Reloading files...</p>');
          			$('#file_i').val('');
          			$('#msgstatus_i').html('');
          			ftpfileoptions = '<img src="<?php echo base_url(); ?>/public/uploads/testimonials/img/thumb_56_56/'+data.ftpfilearray+'">';
          			$('#localimage_i').html(ftpfileoptions);
          			ftpfilearray = data.ftpfilearray;
          			document.getElementById("imagename").value = ftpfilearray;
      			}
      		}
        });
	 return false;
  });
});

</script>   

<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open('/testimonials/create', $attributes) : form_open('/testimonials/edit/'.$id, $attributes);
?>
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<ul>
    			<li id="toolbar-new" class="listbutton">
        			<a>
        			<?php echo form_submit( 'submit', ($updType == 'edit') ? '' : '', (($updType == 'create') ? "id='submit' class='save_btn'" : "id='submit' class='save_btn'")); ?><br />Save
        			</a>
    			</li>
                <li id="toolbar-new" class="listbutton">
                    <a href='<?php echo base_url(); ?>testimonials/' class='bforward'><span class="icon-32-cancel"> </span>Cancel</a>
                </li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo (($updType == 'edit')?'Edit Testimonial':'Create Testimonial');?></h2></div>
	</div>
</div>
<fieldset class="adminform">
		<legend><?php echo (($updType == 'edit')?'Edit Testimonial':'Create Testimonial');?></legend>
            <table class="admintable" width="100%">
                <tr>
					<td width="20%">Title<span style="color:#FF0000;" class="error">*</span></td>
					<td width="80%">
                            <input id="name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($testimonials->name)) ? $testimonials->name : ''); ?>"  />
                            <span class="error"> <?php echo form_error('name'); ?></span>
					</td>

				</tr>
                <tr>
					<td width="20%">description</td>
					<td width="80%">
                            <textarea name="description" id="description" class="stinput" rows="6">
                            <?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($testimonials->description) && $testimonials->description!='') ? $testimonials->description : ''); ?>
                            </textarea>
                            <span class="error"> <?php echo form_error('description'); ?></span>
                    </td>

				</tr>
                <tr>
					<td> Upload image</td>
					<td>
                        <div id="localimage_i">
                            <?php if (isset($testimonials->image)){ ?>
                                 <img src="<?php echo base_url();?>public/uploads/testimonials/img/thumb_56_56/<?php echo $testimonials->image?>" id="imgname">
                            <?php }else{    ?>
                                 <img src="<?php echo base_url();?>public/uploads/testimonials/img/thumb_56_56/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : ''  ?>" id="imgname">
                            <?php } ?>

                         </div>
                         <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
                                Choose file
                                <input type="file" name="file_i" id="file_i" class="upload_btn" value="">

                         </div>
                         <?php  $imagepath = (isset($testimonials->image)) ? $testimonials->image : ''; ?>
                                <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">
                    </td>
				</tr>
                
            </table>
</fieldset>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />
<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>
<script>
 $(document).ready(
 function()
 {
   	$('#description').redactor();
 }
 );
 </script>

<?php if ($updType == 'edit'): ?>
<?php echo form_hidden('id',$testimonials->id); ?>
<?php endif ?>
<?php echo form_close(); ?>

