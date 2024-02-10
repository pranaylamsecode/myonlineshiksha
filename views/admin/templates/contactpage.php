<?php

  $u_data=$this->session->userdata('loggedin');

  $maccessarr=$this->session->userdata('maccessarr');

  //$this->session->flashdata('message');

?>





<?php

$attributes = array('class' => 'tform', 'id' => '');

echo form_open_multipart(base_url().'admin/pagecreator/editContactPage', $attributes);

?>

<div id="toolbar-box">

	<div class="m">

		<div id="toolbar" class="toolbar-list">

			<ul>

            <li id="toolbar-new" class="listbutton"><a><?php echo form_submit( 'submit','',"id='submit' class='save_btn'"); ?> <br />Save</a>

            </li>

			<li id="toolbar-new" class="listbutton">

            <a href='<?php echo base_url(); ?>admin/pagecreator' class='bforward'><span class="icon-32-cancel"> </span>Cancel </a>

			</li>

			</ul>

			<div class="clr"></div>

		</div>

		<div class="pagetitle icon-48-generic"><h2><?php echo "Edit Contact Page";?></h2></div>

	</div>



</div>





<div>

    <h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>

</div>

<?php

if($page[0]['settings'])

{

  $settingarr=json_decode($page[0]['settings']);

  $address=$settingarr->address;

  $phone=$settingarr->phone;

  $email=$settingarr->email;

  $weburl=$settingarr->weburl;

  $mapcode=$settingarr->mapcode;

}

else

{

    $address="";

    $phone="";

    $email="";

    $weburl="";

    $mapcode="";

}

?>

<div class="tab-content">

	<!--Main fieldset-->

	<fieldset class="adminform">

        <legend>Edit Contact Page</legend>

		<table class="adminform">

		<tbody>

			<tr>

				<td width="15%">
						<label class='labelform' for="name"><?php echo "Title"; ?><span class="required">*</span></label>
				</td>

				<td>
                     <?php echo form_input('heading',$page[0]['heading']); ?>

                      <?php echo form_hidden('pageid',$page[0]['page_id']); ?>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="contheading-target" class="tooltipicon" title="Click Here"></span>
						<span class="contheading-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('page_fld_title');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
                     <span class="error"><?php echo form_error('heading'); ?></span>

				</td>

			</tr>



            <tr>

				<td width="15%">
						<label class='labelform' for="name"><?php echo "Description"; ?><span class="required">*</span></label>
<!-- tooltip area -->
<!--						<span class="tooltipcontainer">
						<span type="text" id="desc-target" class="tooltipicon" title="Click Here"></span>
						<span class="desc-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>-->
						<!--tip containt-->
						<?php //echo lang('page_fld_description');?>
                         <!--/tip containt-->
<!--						</span>
						</span>-->
<!-- tooltip area finish -->
				</td>

				<td>
                    <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''));?>

                     <textarea name="description" id="description" class="stinput" rows="6">

                         <?php echo ($this->input->post('description')) ? $this->input->post('description') : ($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''); ?></textarea>

                     <span class="error"><?php echo form_error('description'); ?></span>

				</td>

			</tr>



            <tr>

				<td width="15%">
						<label class='labelform' for="name"><?php echo "Address"; ?><span class="required">*</span></label>
				</td>

				<td>
                     <?php echo form_textarea('address',$address); ?>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="address-target" class="tooltipicon" title="Click Here"></span>
						<span class="address-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('contactpage_fld_address');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
                     <span class="error"><?php echo form_error('address'); ?></span>

				</td>

			</tr>
            <tr>

				<td width="15%">
						<label class='labelform' for="name"><?php echo "Phone"; ?><span class="required">*</span></label>
				</td>

				<td>
                     <?php echo form_input('phone',$phone); ?>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="phone-target" class="tooltipicon" title="Click Here"></span>
						<span class="phone-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('contactpage_fld_phone');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
                     <span class="error"><?php echo form_error('phone'); ?></span>
				</td>

			</tr>



            <tr>

				<td width="15%">
						<label class='labelform' for="name"><?php echo "Email"; ?><span class="required">*</span></label>
				</td>

				<td>
                     <?php echo form_input('email',$email); ?>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="email-target" class="tooltipicon" title="Click Here"></span>
						<span class="email-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('contactpage_fld_email');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
                     <span class="error"><?php echo form_error('email'); ?></span>

				</td>

			</tr>



            <tr>

				<td width="15%">
						<label class='labelform' for="name"><?php echo "Web"; ?><span class="required">*</span></label>
				</td>

				<td>
                     <?php echo form_input('weburl',$weburl); ?>
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="web-target" class="tooltipicon" title="Click Here"></span>
						<span class="web-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('contactpage_fld_web');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
                     <span class="error"><?php echo form_error('weburl'); ?></span>

				</td>

			</tr>



             <tr>

				<td width="15%">
						<label class='labelform' for="name"><?php echo "Map Code"; ?><span class="required">*</span></label>
				</td>

				<td>
                     <?php echo form_textarea('mapcode',$mapcode); ?>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="map_code-target" class="tooltipicon" title="Click Here"></span>
						<span class="map_code-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('contactpage_fld_map-code');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
                     <span class="error"><?php echo form_error('mapcode'); ?></span>

				</td>

			</tr>





		</tbody>

		</table>

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

	</fieldset>

</div>

<?php echo form_close(); ?>


<!-- tool tip script -->
<script type="text/javascript">
$(document).ready(function(){
	$('.tooltipicon').click(function(){
	var dispdiv = $(this).attr('id');
	$('.'+dispdiv).css('display','inline-block');
	});
	$('.closetooltip').click(function(){
	$(this).parent().css('display','none');
	});
	});
	</script>
<!-- tool tip script finish -->
