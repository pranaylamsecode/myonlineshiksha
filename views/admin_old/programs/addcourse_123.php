<base href="<?php echo $this->config->item('base_url') ?>/public/" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
function addcourse (idu, img_type, name, published) {
        if ($('#tr'+idu,parent.document).length > 0) {
        parent.jQuery.fancybox.close();
        return true;
        }else{
		var myrow = parent.document.createElement('tr');
		myrow.id = 'tr'+idu;
		window.parent.document.getElementById('preqfiles').value = window.parent.document.getElementById('preqfiles').value+idu+',';
	   window.parent.document.getElementById('rowspreq').appendChild(myrow);

        var mycell = parent.document.createElement('td');
		mycell.style.textAlign = 'left';
		myrow.appendChild(mycell);
        var mycelltwo = parent.document.createElement('td');
		mycelltwo.style.textAlign = 'left';
		myrow.appendChild(mycelltwo);
		var mycellthree = parent.document.createElement('td');
		mycellthree.style.textAlign = 'left';
		myrow.appendChild(mycellthree);
        var mycellfour = parent.document.createElement('td');
		mycellfour.style.display = 'none';
		myrow.appendChild(mycellfour);

        var yes_no = "";
	   //	var publish = "";

	  /*	if(published==1){
			yes_no = "unpublish";
publish = '<a title="Unpublish Item" href="<?php echo base_url(); ?>/admin/medias/unpublish/'+idu+'\"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>';
		}
		else{
			yes_no = "publish";
publish = '<a title="Publish Item" href="<?php echo base_url(); ?>/admin/medias/publish/'+idu+'\"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a> ';
		}*/ 
        var remove = '<a href="javascript:void(0);" class="removeele" id="remove'+idu+'"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png" alt="delete"/></a>';
       	var id_string = idu

       	var name_string = name
       //	var publish_string = publish
        req_id = '<input type="hidden" value="'+idu+'" name="req_id[]"/>';

        mycell.innerHTML = id_string;
        mycelltwo.innerHTML=img_type;
		mycellthree.innerHTML=remove;
		mycellfour.innerHTML=req_id;
        parent.jQuery.fancybox.close();
return true;
	}
    }
</script>


<base href="<?php echo $this->config->item('base_url') ?>/public/" />
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/colour_standard.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

<div id="toolbar-box">
	<div class="m">
		<div class="toolbar-list" id="toolbar">
			<ul>
    			<li class="listbutton" id="toolbar-new">
                <!--<a id="forward" class="bforward" href="<?php echo base_url(); ?>admin/quizzes/create_final"><span class="icon-32-cancel"> </span>Cancel</a>-->
                <a href='<?php echo base_url(); ?>/admin/programs/create/' class='bforward' id="forward" onclick="window.parent.location.href = '<?php echo base_url(); ?>/admin/programs/create/';">
<span class="icon-32-cancel"></span>Cancel</a>
    			</li>
			</ul>
			<div class="clr"></div>
		</div>
<div class="pagetitle"><h2>Course List</h2></div>
	</div>
</div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart('admin/programs/addcourse',$attributes);
?>
<table cellspacing="5" cellpadding="5" bgcolor="#FFFFFF">
		<tbody><tr>
			<td>
               	<input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text">

				<input type="submit" value="Search" name="submit_search">
				<input type="submit" value="Reset" name="reset">

			</td>

		</tr><tr>
	</tr></tbody></table>
    <?php echo form_close(); ?>
<table class="adminlist" style="width: 100%;">
<thead>
	<tr>
	   <th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>
	   <th width="20">ID</th>
	   <th>Course Tree (#modules)</th>
       <th>Published</th>
   </tr>
</thead>
<?php if ($programs): ?>

<tbody>
<?php $i=0;?>
<?php foreach ($programs as $program): ?>
	<tr class="camp<?php echo $i;?>">
		<td><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $program->id?>"></td>	    <td>
	     	<?php echo $program->id;?></td>
	    <td>

            <a href="javascript:addcourse(<?php echo $program->id?>,'<?php echo $program->name?>',<?php echo $program->published?>)" class="a_mlms">
			<?php echo $program->name?></a>

		</td>
		<td align="center">
		<?php if($program->published){?>
		<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png">
		<?php }else{?>
		<img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></td>
		<?php }?>

	   </tr>

<?php endforeach ?>

</tbody>
</table>
<div class="containerpg"><div class="pagination">
<?php //echo $this->pagination->create_links();  ?>
</div></div>
<?php else: ?>

<p class='text'><?=lang('web_no_elements');?></p>

<?php endif ?>
