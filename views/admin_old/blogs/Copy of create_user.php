<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

<script type="text/javascript">

$(function() {

	$('#file_i').live('change',function(e) {

	 var ftpfilearray;

	 e.preventDefault();

		$.ajaxFileUpload({

		url :'<?php echo base_url(); ?>admin/users/upload_image/',

		secureuri :false,

		fileElementId :'file_i',

		dataType : 'json',

		data : {

		'type' : $('select#type').val()

		},

		success : function (data, status)

		{

		//alert(data);

			if(data.status != 'error')

			{

			$('#msgstatus_i').html('<p>Reloading files...</p>');

			$('#file_i').val('');

			$('#msgstatus_i').html('');

			ftpfileoptions = '<img src="<?php echo base_url(); ?>/public/uploads/users/img/'+data.ftpfilearray+'" width="150">';

		  //	alert(ftpfileoptions);

			$('#localimage_i').html(ftpfileoptions);

			ftpfilearray = data.ftpfilearray;

           // alert(ftpfilearray);

			document.getElementById("imagename").value = ftpfilearray;

			}

		}

		});

	 return false;

	});

});



</script>

<script type="text/javascript">

window.onload = function() {

showhidefields();

}

function showhidefields(){

	var selvalue = document.getElementById("group_id").selectedIndex;

    if(selvalue == '1')

	{

	document.getElementById("twitter_td").style.display="table-row";

	document.getElementById("facebook_td").style.display="table-row";

	document.getElementById("blogurl_td").style.display="table-row";

	document.getElementById("websiteurl_td").style.display="table-row";

	document.getElementById("bio_td").style.display="table-row";

    document.getElementById("email_td").style.display="table-row";

	document.getElementById("title_td").style.display="table-row";

	document.getElementById("stdemail_td").style.display="none";



	}else

	{

    document.getElementById("twitter_td").style.display="none";

	document.getElementById("facebook_td").style.display="none";

	document.getElementById("blogurl_td").style.display="none";

	document.getElementById("websiteurl_td").style.display="none";

	document.getElementById("bio_td").style.display="none";

    document.getElementById("email_td").style.display="none";

	document.getElementById("title_td").style.display="none";

    document.getElementById("stdemail_td").style.display="table-row";



	}

}

</script>



<script>

/*function checkvalid(){

	if (document.checkuser.email.value=='') {

			alert("You must have at least one answer for your question");

			return true;

	   }

      //return true;

}*/

</script>

<?php

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open(base_url().'admin/users/create', $attributes) : form_open(base_url().'admin/users/edit/'.$id, $attributes);

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

            <a href='<?php echo base_url(); ?>/admin/users/' class='bforward'><span class="icon-32-cancel"> </span>Cancel</a>

            </li>

			</ul>

			<div class="clr"></div>

		</div>

		<div class="pagetitle icon-48-generic"><h2><?php echo 'Edit User';?></h2></div>

	</div>

</div>

<div>

    <h2><?php ($updType == 'create') ? "Create Lesson" : "Edit Lesson";//echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2>



    <span class="clearFix">&nbsp;</span>

</div>



	<fieldset class="adminform">

		<legend>Edit User</legend>

<table class="admintable" width="100%">

                <tr>

					<td width="20%">First Name<span style="color:#FF0000;" class="error">*</span></td>

					<td width="80%">

                       <input id="first_name" type="text" name="first_name" maxlength="256" value="<?php echo set_value('first_name', (isset($user->first_name)) ? $user->first_name : ''); ?>"  />

      <?php echo form_error('first_name'); ?><b>&nbsp;</b>

					</td>



				   </tr>



				 <tr>

					<td>Last Name<span style="color:#FF0000;" class="error">*</span></td>

					<td>

                        <input id="last_name" type="text" name="last_name" maxlength="256" value="<?php echo set_value('last_name', (isset($user->last_name)) ? $user->last_name : ''); ?>"  />

      <?php echo form_error('last_name'); ?>

                    </td>

				</tr>

                <tr>

					<td>Group<span style="color:#FF0000;" class="error">*</span></td>

					<td>

                    	<?php

                            /*$combocategories = $this->users_model->get_formatted_combo();

                    		foreach($combocategories as $combocat){

                               print_r($combocat->id);

                               print_r($groups[0]);



                             }*/





                            ?>

                         <?php



                         ?>

                       <select onchange="javascript:showhidefields(this.selectedIndex)" name='group_id' id='group_id'>

                        <?php

                    	   	$combocategories = $this->users_model->get_formatted_combo();

                    		foreach($combocategories as $combocat):

                         ?>

                           <option value='<?php echo $combocat->id?>' <?php //echo ($combocat->id==$groups->id)?'disabled':'';?> <?php echo ($this->input->post('group_id') == $combocat->id) ? "selected=selected" : (isset($groups) && in_array($combocat->id,$groups)) ? "selected=selected" : '' ?>><?php echo $combocat->title?></option>

                            <?php endforeach ?>

                       </select>

	                   <?php echo form_error('group_id'); ?>

                    </td>

				</tr>



                <tr>

					<td>Email<span style="color:#FF0000;" class="error">*</span></td>

					<td>

                         <input id="email" type="text" name="email" maxlength="256" value="<?php echo set_value('email', (isset($user->email)) ? $user->email : ''); ?>"  />

                        <?php echo form_error('email'); ?>



                    </td>

				 </tr>

                 <tr>

					<td>User Name<span style="color:#FF0000;" class="error">*</span></td>

					<td>

                         <input id="username" type="text" name="username" maxlength="256" value="<?php echo set_value('username', (isset($user->username)) ? $user->username : ''); ?>"  />

                        <?php echo form_error('username'); ?>



                    </td>

				 </tr>

                 <tr>

					<td>Password<span style="color:#FF0000;" class="error">*</span></td>

					<td>

                         <input id="password" type="password" name="password" maxlength="256" autocomplete="off" value="<?php echo set_value('password'); ?>"  />

                         <?php echo form_error('password'); ?>



                    </td>

				 </tr>

                 <tr>

					<td>Confirm Password<span style="color:#FF0000;" class="error">*</span></td>

					<td>

                         <input id="password_confirm" type="password" name="password_confirm" autocomplete="off" maxlength="256" value="<?php echo set_value('password_confirm'); ?>"  />

        <?php echo form_error('password_confirm'); ?>



                    </td>

				 </tr>

                 <tr>

					<td> Upload image</td>

					<td>

                    <div id="localimage_i">

                        <?php if (isset($user->images)){ ?>

                        <img src="<?php echo base_url();?>public/uploads/users/img/<?php echo $user->images?>" width="150" id="imgname">

                        <?php }else{    ?>

                        <img src="<?php echo base_url();?>public/uploads/users/img/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : ''  ?>" width="150" id="imgname">

                        <?php } ?>



                        </div>

                         <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">

                         Choose file

                         <input type="file" name="file_i" id="file_i" class="upload_btn" value="">



                        </div>

                         <?php  $imagepath = (isset($user->images)) ? $user->images : ''; ?>

                          <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">

                    </td>

				 </tr>

                <tr>

					<td> Active</td>

                    <td>



                        <input id="active" type="checkbox" name="active" value='1' <?php echo ($this->input->post('active') == '1') ? "checked" : (isset($user->active) && $user->active == '1') ? "checked" : ''?> />



                    </td>

				 </tr>

            <tr style="display:none;" id="title_td">

			<td>

				Title:

			</td>

			<td>

				<input type="text" size="40" class="inputbox" value="<?php echo set_value('author_title', (isset($user->author_title)) ? $user->author_title : ''); ?>" name="author_title">



			</td>

	  	</tr>

	    <tr style="display:none;" id="websiteurl_td">

			<td>

				Website URL:

			</td>

			<td>

				<input type="text" size="40" class="inputbox" value="<?php echo set_value('website', (isset($user->website)) ? $user->website : 'http://'); ?>" name="website">

				<select name="show_website" id="show_website">

                	<option value="1" <?php echo preset_select('show_website', '1', (isset($user->show_website)) ? $user->show_website : ''  ) ?>>Show</option>

                	<option value="0" <?php echo preset_select('show_website', '0', (isset($user->show_website)) ? $user->show_website : ''  ) ?>>Hide</option>

                </select>

			</td>

	  	</tr>

		<tr style="display:none;" id="blogurl_td">

			<td>

				Blog URL:

			</td>

			<td>

				<input type="text" size="40" class="inputbox" value="<?php echo set_value('blog', (isset($user->blog)) ? $user->blog : 'http://'); ?>" name="blog">

				<select name="show_blog" id="show_blog">

                	<option value="1" <?php echo preset_select('show_blog', '1', (isset($user->show_blog)) ? $user->show_blog : ''  ) ?>>Show</option>

                	<option value="0" <?php echo preset_select('show_blog', '0', (isset($user->show_blog)) ? $user->show_blog : ''  ) ?>>Hide</option>

                </select>



			</td>

	  	</tr>

	  <tr style="display:none;" id="facebook_td">

			<td>

				Facebook page URL:

			</td>

			<td>

				<input type="text" size="40" class="inputbox" value="<?php echo set_value('facebook', (isset($user->facebook)) ? $user->facebook : 'http://'); ?>" name="facebook">

				<select name="show_facebook" id="show_facebook">

                	<option value="1" <?php echo preset_select('show_facebook', '1', (isset($user->show_facebook)) ? $user->show_facebook : ''  ) ?>>Show</option>

                	<option value="0" <?php echo preset_select('show_facebook', '0', (isset($user->show_facebook)) ? $user->show_facebook : ''  ) ?>>Hide</option>

                </select>



			</td>

	  	</tr>

	    <tr style="display:none;" id="twitter_td">

			<td>

				Twitter ID:

			</td>

			<td>

				<input type="text" size="40" class="inputbox" value="<?php echo set_value('twitter', (isset($user->twitter)) ? $user->twitter : ''); ?>" name="twitter">

				<select name="show_twitter" id="show_twitter">

                	<option value="1" <?php echo preset_select('show_twitter', '1', (isset($user->show_twitter)) ? $user->show_twitter : ''  ) ?>>Show</option>

                	<option value="0" <?php echo preset_select('show_twitter', '0', (isset($user->show_twitter)) ? $user->show_twitter : ''  ) ?>>Hide</option>

                </select>



			</td>

	  	</tr>

        <tr style="display:none;" id="bio_td">

			<td>

				Biography:

			</td>

			<td>    Enter the teacher's biography. This biography will be displayed on their profile on the front end

					<?php

                     $full_bio = (isset($user->full_bio)) ? $user->full_bio : '';

                    //$this->ckeditor->editor("full_bio",(isset($user->full_bio)) ? $user->full_bio : '');?>

					<?php $this->ckeditor->editor("full_bio",$full_bio);?>



			</td>

	  	</tr>



</table>

</fieldset>



<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$user->id); ?>

<?php endif ?>

<?php echo form_close(); ?>



