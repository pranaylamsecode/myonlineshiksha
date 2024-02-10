

<div id="toolbar-box">

	<div class="m">

		<div id="toolbar" class="toolbar-list">

			<ul>

			<li id="toolbar-new" class="listbutton">

            <a href="<?php echo base_url(); ?>admin/blogs/create/"  class="toolbar">

			<span class="icon-32-new">

			</span>

			New

			</a>

			</li>

			</ul>

			<div class="clr"></div>

		</div>

		<div class="pagetitle icon-48-generic"><h2><?php echo 'Users Manager';?></h2></div>

	</div>

</div>

<div>

    <?php if (isset($control)): ?>

    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>

    <?php endif ?>

    

    <span class="clearFix">&nbsp;</span>

</div>

<div class='clear'></div>

<!--<table cellspacing="5" cellpadding="5" bgcolor="#FFFFFF" style="width:90%;">

		<tbody><tr>

			<td>

				<input type="text" value="" name="search_text">

				<input type="submit" value="Search" name="submit_search">

			</td>

			<td>Published status

				<select name="course_publ_status" onchange="document.topform1.submit()">

					<option value="YN">- select -</option>

					<option value="Y">Published</option>

					<option value="N">Unpublished</option>

				</select>

			</td>

		</tr><tr>

	</tr></tbody></table>-->

    <!--<table class="zone_description" style="width:90%;">

	<tbody><tr>

		<td style=" padding-left: 5px;">Here's where you set up subscription plans for your courses. You can keep the default plans or create new ones</td>

	</tr>

</tbody></table>-->

<table class="adminlist" width="100%">

	<thead>

		<tr>

			<th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>

			<th width="20">ID</th>

			<th>First Name</th>

			<th>Email</th>

			<th width="100">Options</th>

		</tr>

	</thead>

<?php if ($users): ?>

<tbody>

<?php $i=0;?>

	<?php foreach ($users as $user):?> 

	<tr class="camp<?php echo $i;?>">

    		<td><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $user->id?>"></td>

        <td><?php echo $user->id;?></td>

        <td><a href="<?php echo base_url(); ?>admin/users/edit/<?php echo $user ->id?>">

	    <?php echo $user->first_name;?></a></td>

		<td><?php echo $user->email;?></td>

        <!-- <td><a class='ledit' href='<?php echo base_url(); ?>admin/users/edit/<?php echo $user ->id?>'>Edit</a><a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/users/delete/<?php echo $user->id?>/<?php echo $this->uri->segment(3)?>'>Delete</a></td> -->
        <td><a class='ledit' href='<?php echo base_url(); ?>admin/users/edit/<?php echo $user ->id?>'>Edit</a><a class='ldelete' onClick="return deleteconfirm('<?php echo $user->id?>')?>','<?php echo $this->uri->segment(3)?>')" >Delete</a></td>

	</tr>

<?php endforeach ?>

	<tr>

		<td colspan="8"><div class="containerpg">

		<div class="pagination">



		</div>

		</div>

		</td>

		</tr>



</tbody>



	<?php //echo $links; ?>



</table>

<?php else: ?>



	<p class='text'><?=lang('web_no_elements');?></p>



<?php endif ?> 

<script type="text/javascript"> 
var $ =jQuery.noConflict(); 
	function deleteconfirm(id,seg)
	{

		 $.confirm({
               title: 'Do you really want to delete blog ?',
               content: ' ',
               confirm: function(){ 
                                window.location.href = "<?php echo base_url(); ?>admin/users/delete/"+id+"/"+seg;

                                   },
               cancel: function(){        
                               return true;
                                       }
                             });
	}

</script>

