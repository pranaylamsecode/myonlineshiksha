<base href="<?php echo $this->config->item('base_url') ?>public/" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>public/css/my_frontend.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/classic/css/bootstrap.css" media="screen" />
<style>
input[type="radio"], input[type="checkbox"] {
	margin: 0px 10px 0 0 !important;
	margin-top: 1px \9;
	line-height: normal;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
	margin: 0 10px !important;
}
td, th {
	padding: 10px !important;
}
.panel-body{padding: 0 !important;}
/*css*/
.top-content {
  background-color: #f1f1f1;
  height: 73px;
}
legend {
  display: block;
  width: 100%;
  margin-bottom: 20px;
  font-size: 21px;
  line-height: 40px;
  color: #333333;
  color: #c42140!important;
  text-transform: uppercase;
  font-size: 21px;
  text-align: center;
  font-weight: bold;
  padding: 10px 30px 0 30px!important;
  border: 0;
  border-bottom: none!important;
}
form {
  margin-bottom: 20px!important;
}
table.scroll {
    /* width: 100%; */ /* Optional */
    /* border-collapse: collapse; */
    border-spacing: 0;
    /*border: 2px solid black;*/
	width: 100%;
}

table.scroll tbody,
table.scroll thead { display: block; }

table.scroll tbody {
      height: 215px;
  overflow-y: auto;
  overflow-x: hidden;
  border-bottom: 1px solid #ebebeb;
}


tbody td:last-child, thead th:last-child {
    border-right: none;
}
table {
	border-collapse: inherit;
	border:none !important;
}
input.btn.btn-success {
  background-color: #5bb75b;
  background-image: none!important;
  border: #5bb75b!important;
}
input.btn.btn-default{
  background-image: none!important;
  border: none!important;
  background-color: #cc2424;
  color: #fff!important;
}
a{
	color:#000!important;
}
a:hover{
	color:#000!important;
}
.panel {
  border:none!important;
  border-radius: 3px;
}
/*end of css*/
</style>

<script type="text/javascript">
function addcourse (idu,img_type, name, published) {
	//var img_type ="";
        if ($('#tr'+idu,parent.document).length > 0) {
          $("#cboxClose",parent.document).click();
        //parent.jQuery.fancybox.close();
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
        var remove = '<a href="javascript:void(0);" onclick="deleteRow1(this.parentNode.parentNode.rowIndex)" class="removeele" id="remove'+idu+'"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png" alt="delete"/></a>';
       	var id_string = idu

       	var name_string = name
       //	var publish_string = publish
        req_id = '<input type="hidden" value="'+idu+'" name="req_id[]"/>';

        mycell.innerHTML = id_string;
        mycelltwo.innerHTML=img_type;
		mycellthree.innerHTML=remove;
		mycellfour.innerHTML=req_id;
       // parent.jQuery.fancybox.close();
        $("#cboxClose",parent.document).click();
return true;
	}
    }
</script>


<div class="page-container">
 
    <div class="top-content">
      <legend>Course List</legend>
	  <div>Single click on the courses to add them to the lists of prerequisite courses.</div>
    </div>
   <div class="main-content">  
    <div class="panel panel-primary">
      <div class="panel-body">
<fieldset class="adminform form-horizontal form-groups-bordered">
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'programs/addcourse',$attributes);
?>
<table cellspacing="5" cellpadding="5" bgcolor="#FFFFFF">
		<tbody><tr>
			<td>
               	<input placeholder="Course Name" type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text">

				<input type="submit" value="Search" name="submit_search" class="btn btn-success">
				<input type="submit" value="Reset" name="reset" class="btn btn-default">

			</td>

		</tr><tr>
	</tr></tbody></table>
    <?php echo form_close(); ?>
<table class="table table-bordered datatable dataTable scroll" style="width: 100%;font-size:15px;">
<thead>
	<tr>
	   <!--<th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>-->
	   <th width="20" style="color:#000;width:9.3%">ID</th>
	   <th style="color:#000;width:76%">Course Tree (#modules)</th>
       <th style="color:#000;">Published</th>
   </tr>
</thead>
<?php if ($programs): ?>

<tbody>
<?php $i=0;?>
<?php foreach ($programs as $program): ?>
	<tr class="camp<?php echo $i;?>">
		<!--<td><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $program->id?>"></td>-->	    
		<td>
	     	<?php echo $program->id;?>
	     </td>
	    <td style="width:79%;">

            <a href="javascript:addcourse(<?php echo $program->id?>,'<?php echo $program->name?>',<?php echo $program->published?>)" class="a_mlms">
			<?php echo $program->name?></a>

		</td>
		<td style="width:16%;" align="center" >
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
</fieldset>
</div>
</div>
</div>
</div>