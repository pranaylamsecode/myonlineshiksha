<?php


  $u_data=$this->session->userdata('loggedin');


  $maccessarr=$this->session->userdata('maccessarr');


?>





<!--<script>


     $(function() {


       $( "#from-datepicker" ).datepicker({


        showOn: "button",


        buttonImage: "<?php echo base_url()?>public/images/admin/calendar.png",


        buttonImageOnly: true,


        dateFormat: "dd-mm-yy"





       });


     });


  </script>





  <script>


    $(function() {


      $( "#to-datepicker" ).datepicker();


    });


  </script>-->


<?php


$attributes = array('class' => 'tform', 'id' => '');


echo ($updType == 'create') ? form_open_multipart('admin/groups/create', $attributes) : form_open_multipart('admin/groups/edit/'.$id, $attributes);


?>


<div id="toolbar-box">


	<div class="m">


		<div id="toolbar" class="toolbar-list">


			<ul>


            <li id="toolbar-new" class="listbutton"><a><?php echo form_submit( 'submit', ($updType == 'edit') ? "" : "", (($updType == 'create') ? "id='submit' class='save_btn'" : "id='submit' class='save_btn'")); ?> <br />Save</a>


            </li>        


			<li id="toolbar-new" class="listbutton">


            <a href='<?php echo base_url(); ?>admin/groups<?php //echo $quiz->category_id?>/<?php //echo $page?>' class='bforward'><span class="icon-32-cancel"> </span>Cancel </a>


			</li>


			</ul>


			<div class="clr"></div>


		</div>


		<div class="pagetitle icon-48-generic"><h2><?php echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2></div>


	</div>


</div>


<div>


    <h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>


   <?php if($updType != 'edit'){


		$id = '';


		}?>


</div>





<div class="tab-content">


	<!--Main fieldset-->


	<fieldset class="adminform">


     <?php if($updType != 'edit'){ ?>


      	<legend>Add Group</legend>


     <?php }else{ ?>


        <legend>Edit Group</legend>


     <?php } ?>


		<table class="adminform">


		<tbody>


			<tr>


				<td width="15%">


					<p>


						<label class='labelform' for="name"><?php echo lang('web_name')?><span class="required">*</span></label>


					</p>


				</td>


				<td>


					<p>





                     <select name='pid' id='pid'>


                         <option value=''>- select</option>


                		<?php


                		$combocategories = $this->groups_model->get_formatted_combo();


                		foreach ($combocategories as $combocat): ?>


 <option value='<?php echo $combocat->id?>' <?php //echo ($combocat->id==$groups->id)?'disabled':'';?> <?php echo preset_select('pid', $combocat->id, (isset($groups->parent_id)) ? $groups->parent_id : $id  ) ?>><?php echo $combocat->title?></option>


                		<?php endforeach ?>


                	</select>


					</p>


                     <span class="error"><?php echo form_error('pid'); ?></span>


				</td>


			</tr>


            	<tr>


				<td width="15%">


					<p>


						<label class='labelform' for="description">Title<span class="required">*</span></label>


					</p>


				</td>


				<td>


                  <p>


                    <input id='title' type='text' name='title' maxlength='60' value="<?php echo set_value('title', (isset($groups->title)) ? $groups->title : ''); ?>"   />





                 </p>


                    <span class="error"><?php echo form_error('title'); ?></span>


                </td>


			</tr>


             <!-- <div style="float:left; width:330px">


     <input name="from-date" type="text" id="from-datepicker" />


  </div>





  <div style="float:left; width:330px">


     <input name="to-date" type="text" id="to-datepicker" />


  </div>-->





		</tbody>


		</table>


	</fieldset>


</div>


<?php if ($updType == 'edit'): ?>


	<?php echo form_hidden('id',$groups->id) ?>


<?php endif ?>





<?php echo form_close(); ?>


