<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<div class="main-container">
<style>
.coup_course{
	cursor: pointer;
	list-style-type: none;
	padding: 10px;
	font-size: 14px;
}
.coup_course:hover{
   background-color: #edeef0;
}
#sel_course{
    position: relative;
    margin-top: 30px;
    margin-bottom: 30px;
}

.txt_list {
    padding: 6px;
    background-color: #9a9a9a;
    border-radius: 15px;
    color: white;
    margin: 15px;
    margin-right: 5px;
}
div #sel_course a {
	padding: 6px;
	background-color: #9a9a9a;
	border-radius: 15px;
	color: white;
	margin: 1px 1px;
	display: inline-block;
	font-size: 14px;
}
ul #getitemlist1 {
    padding-left: 0px;
    background: #fff;
    border: 1px solid #ddd;
    margin-top: 0px;
    border-top: 0px;
}

ul #getitemlist1:hover {
    background: #fff;
}
	</style>
<?php
$attributes = array('class' => 'tform', 'id' => '', 'autocomplete'=>"off","onsubmit"=>"return validation()");
echo ($updType == 'create') ? form_open(base_url().'admin/promocodes/create', $attributes) : form_open(base_url().'admin/promocodes/edit/'.$id, $attributes);
?>
<?php function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;
    if( $estimate_time < 1 )
    {
        return 'Just Now';
    }
    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );
    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;
        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}  ?>
	<div id="toolbar-box">
	  <div class="m">
	    <div class="pagetitle icon-48-generic">
	    	<h2><?php echo ($updType == 'create') ? 'Add Coupon' : 'Edit Coupon';?></h2>
	    	
	    </div>
	  </div>
	</div>
<link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">
<div class="field_container">
<div class="row content">

			<form role="form" class="form-horizontal form-groups-bordered">
				<div class="form-group form-border" style="padding-top: 0!important;">
					<label for="field-1" class="col-sm-12 control-label field-title">Coupon code<font color="#FF0000">* </font><span id="err_code"></span>
						<p>Alpha-numeric characters only. e.g. CHRISTMAS101, 50OFF, DIWALI10</p>
					</label>
					<div class="col-sm-12">
						<input type="text" class="form-control form-height" placeholder="Code" name="code" id="code" value="<?php echo set_value('code', (isset($promocodes->code)) ? $promocodes->code : ''); ?>">
						<span class="error"><?php echo form_error('code'); ?></span>
					</div>
				</div>
               	<div class="form-group form-border">
					<label for="field-1" class="col-sm-12 control-label field-title">Short description<font color="#FF0000">* </font><span id="err_description"></span></label>
					<div class="col-sm-12">
                        <input id="title" class="form-control form-height" type="text" name="title" maxlength="256" value="<?php echo set_value('title', (isset($promocodes->title)) ? $promocodes->title : ''); ?>" placeholder="Enter short description"/>
                    	<span class="error"><?php echo form_error('title'); ?></span>
					</div>
				</div>
				<div class="form-group form-border" >
				  	<div class="col-sm-12 Sel_div" >
						<label for="field-1" class="control-label field-title">Coupon applied for</label>
						<div class="grey-background">
							<div style="display:inline;">
								<input class="coupon_for" name="coupon_for" type="radio" checked="" value="0" <?php echo ($this->input->post('coupon_for')) ? 'checked="checked"' : (isset($promocodes->coupon_for) && $promocodes->coupon_for == '0') ? 'checked="checked"' : ''?> name="coupon_apply">
								<span>All Over Site</span>
							</div>
							<div style="display:inline;padding-left:2%;">
								<input class="coupon_for" name="coupon_for" type="radio" value="1" <?php echo ($this->input->post('coupon_for')) ? 'checked="checked"' : (isset($promocodes->coupon_for) &&$promocodes->coupon_for == '1') ? 'checked="checked"' : '' ?> name="coupon_apply">
								<span>Selected Course</span>
							</div>
						</div>
				  	</div>
                </div>
				<!-- search course -->
				<div class="form-group form-border select_course" style="padding-top: 0!important; display: <?php echo (isset($promocodes->coupon_for) &&$promocodes->coupon_for == '1') ? 'block' : 'none'?>">
					<div class="col-sm-12">
						<input type="hidden" name="coupon_course" id="sel_course_id" value="<?php echo set_value('coupon_course',(isset($promocodes->coupon_course)) ? $promocodes->coupon_course : '');?>">	
						<div id="sel_course">
							<?php if($updType == 'edit'){
								$CI = & get_instance();
								if(isset($promocodes->coupon_course) && $promocodes->coupon_course != '')
								{
									$CI->load->model('admin/programs_model');
									$cou_list = $CI->programs_model->getProgramTitle($promocodes->coupon_course);
									if($cou_list){
										foreach ($cou_list as $list) {
											echo "<a href='javascript:void(0)' class='cut_ele' id='txt_".$list->id."' ><span class='txt_list' >".$list->name."</span>&times</a>";
										}
									}
								}
							} ?>
						</div>
						<input autocomplete="none" id="getlistitem1" type="text" name="searchtext" value="" class="form-control form-height" placeholder="Search a course for you" style="color:black;">
						<ul id="getitemlist1" style="display: none"></ul>
					</div>
				</div>
				<div class="form-group form-border" style="padding-top: 0!important;">
					<label for="field-1" class="col-sm-12 control-label field-title">Number of times coupon can be used <p>Put numeric value only, leave empty if no limits.</p>
					</label>
					<div class="col-sm-12">
						<input type="number" value="<?php echo set_value('codelimit', (isset($promocodes->codelimit)) ? $promocodes->codelimit : ''); ?>" name="codelimit"  class="form-control form-height" placeholder="Usage limit">    
						<span class="error"><?php echo form_error('codelimit'); ?></span>
					</div>
				</div>
				<div class="form-group form-border" style="padding-top:0%!important;">
					<label for="field-1" class="col-sm-12 control-label field-title">Discount <font color="#FF0000">* </font><span id="err_discount"></span></label>
					<div class="col-sm-6">
						<input type="number" class="form-control form-height"  placeholder="Discount amount" value="<?php echo set_value('discount', (isset($promocodes->discount)) ? $promocodes->discount : ''); ?>" name="discount" size="10" id="discount">
						<span class="error"><?php echo form_error('discount'); ?></span>
					</div>
					<div class="col-sm-6">
		    			<div class="grey-background">
							<input type="radio" checked="" value="0" <?php echo ($this->input->post('typediscount') == '0') ? 'checked="checked"' : (isset($promocodes->typediscount) && $promocodes->typediscount == '0') ? 'checked="checked"' : ''; ?> name="typediscount">
								<span> Fixed amount ($)</span>
							<input style="margin-left: 4%;" type="radio" value="1" <?php echo ($this->input->post('typediscount') == '1') ? 'checked="checked"' : (isset($promocodes->typediscount) && $promocodes->typediscount == '1') ? 'checked="checked"' : ''; ?> name="typediscount" id="typediscount">
								<span> In percentage (%)</span>
						</div>
					</div>
                </div>
				<div class="form-group form-border" style="padding-top:0%!important;">
				    <legend>Coupon validity</legend>
					<label for="field-1" class="col-sm-12 control-label field-title">From : <span id="err_from"></span></label>
					<div class="col-sm-12">
                        <div class="controls input-append date form_datetime" data-link-field="dtp_input1">
							<?php
							$pdate = (isset($promocodes->codestart)) ? $promocodes->codestart : '';
							?>
							<input readonly="" type="text" class="form-control form-height" placeholder="Start publishing" maxlength="19" size="25" id="codestart"  value="<?php echo ($this->input->post('codestart')) ? $this->input->post('codestart') : $pdate; ?>"  name="codestart" <?php if($updType == 'edit') { echo 'readonly'; } ?> >
						</div>
					</div>
				</div>
				<div class="form-group form-border">
					<label for="field-1" class="col-sm-12 control-label field-title">To : <span id="err_to"></span></label>
					<div class="col-sm-12">
                        <div class="controls input-append date form_datetime" data-link-field="dtp_input1">
							<?php
								$edate = (isset($promocodes->codeend)) ? $promocodes->codeend : '';
							?>
							<input type="text" readonly="" class="form-control form-height" placeholder="End publishing" maxlength="19" size="25" id="endpublish"  value="<?php echo ($this->input->post('codeend')) ? $this->input->post('codeend') : $edate; ?>"  name="codeend"  <?php if($updType == 'edit') { echo 'readonly'; } ?> >
						</div>
					</div>
				</div>
				<div class="form-group form-border" >
				  	<div class="col-sm-12 Sel_div" >
		    			<div class="grey-background">
							<label class="col-sm-4 control-label field-title" style="padding:0!important;">Publish</label>
							<div style="display:inline;">
								<input type="radio" checked="" value="0" <?php echo ($this->input->post('published')) ? 'checked="checked"' : (isset($promocodes->published) && $promocodes->published == '0') ? 'checked="checked"' : ''?> name="published">
								<span>No</span>
							</div>
							<div style="display:inline;padding-left:2%;">
								<input type="radio" value="1" <?php echo ($this->input->post('published')) ? 'checked="checked"' : (isset($promocodes->published) &&$promocodes->published == '1') ? 'checked="checked"' : '' ?> name="published">
								<span>Yes</span>
							</div>
						</div>
				  	</div>
				</div>
				<?php if(isset($promocodes->codelimit)) { ?>
				<div class="form-group form-border" >
					<legend>Status</legend>
				 	<div class="col-sm-12 Sel_div" >
		    	  		<div class="grey-background">
							<label class="col-sm-4 control-label field-title">Total used</label>
							<div>
								<?php echo $promocodes->codeused;?> <input style="visibility: hidden; width: 2px;">
							</div>
						</div>
					</div>
				</div>
                <?php if($updType == 'edit'){ ?>
				<div class="form-group form-border" >
				  	<div class="col-sm-12 Sel_div" >
		    	  		<div class="grey-background">
							<label class="col-sm-4 control-label field-title">Usage left</label>
							<div>
								<?php echo (int)$promocodes->codelimit - (int)$promocodes->codeused; ?>
								<input style="visibility: hidden; width: 2px;">
							</div>
						</div>
                	</div>
                </div>
				<?php } }
  			    else{ if($updType == 'edit'){ ?>
                <div class="form-group form-border" >
	                <div class="col-sm-12 Sel_div" >
			    	  	<div class="grey-background">
							<label class="col-sm-4 control-label field-title">Usage left</label>
							<div>-<input style="visibility: hidden; width: 2px;"> </div>
						</div>
					</div>
				</div>
              	<?php } }
              	if($updType == 'edit'){
              	?>
				<div class="form-group form-border" >
					<div class="col-sm-12 Sel_div" >
		    	      	<div class="grey-background">
							<label class="col-sm-4 control-label field-title">Time left</label>
							<div>
								<?php
								$date1 = date_create(date('Y-m-d'));
								$date2 = date_create($promocodes->codeend);
								$diff=date_diff($date1,$date2);
								if($diff->invert == 0){
								echo $diff->format('%a days remaining');
								} else { echo "Expired!"; } ?>
									<input style="visibility: hidden; width: 2px;">
							</div>
						</div>
                	</div>
                </div>
				<?php } ?>
				<div class="col-sm-12" >
				<?php echo form_submit( 'submit', ($updType == 'edit') ? 'Update' : 'Update', (($updType == 'create') ? "id='submit' class='btn'" : "id='submit' class='btn btn-default btn-green'") ); ?>
            		<a href='<?php echo base_url(); ?>admin/promocodes/' class='btn'><span class="icon-32-cancel"> </span>Cancel </a>
				</div>	
			</form>	
		
</div>
</div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
$(function() {
	$( "#codestart" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	$( "#endpublish" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
});
</script>
<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$promocodes->id) ?>
<?php endif ?>
<?php echo form_close(); ?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.tooltipicon').mouseenter(function(){		
		var dispdiv = jQuery(this).attr('id');
		jQuery('.'+dispdiv).css('display','inline-block');
	});
	jQuery('.tooltipicon').mouseleave(function(){		
		var dispdiv = jQuery(this).attr('id');
		jQuery('.'+dispdiv).css('display','none');
	});
});
$(document).on('keyup', '#getlistitem1', function(){
	var input = $('#getlistitem1').val();
	$.ajax({
		url: "<?php echo base_url();?>category/getlistforcoupon",
	    type: "POST",
	    data: {input: input},
	    success: function(data) { 
		       	if(data)
		       	{
		        	$('#getitemlist1').show();
		        	$('#getitemlist1').html(data);
		       	}
		       	else{
		         	$('#getitemlist1').hide();
		         	$('#getitemlist1').html();
		       	}
		},
	    error: function(xhr, desc, err) {
	            console.log(xhr);
	    },
	});
});
$(document).on('click', '.coup_course', function(){
	var text = $(this).text();
	var val = $(this).val();
	val1 = '"'+val+'"';
	var input_val = $('#sel_course_id').val();
	var arr = input_val.split(',');
	if($.inArray(val1, arr) == -1)
	{
		$('#sel_course').append("<a href='javascript:void(0)' class='cut_ele' id='txt_"+val+"' ><span class='txt_list' >"+text+"</span>&times</a>");
		$('#sel_course_id').val(input_val + val1+',');
	}
});
$(document).on('click', '.cut_ele' , function(){
	var id = $(this).attr('id');
			$(this).remove();
	var arr_id = id.split('_');
	var input_val = $('#sel_course_id').val();
	var new_str = input_val.replace('"'+arr_id[1]+'",', '');
	$('#sel_course_id').val(new_str);
});
</script>
<style>
.multi-button::after, .multi-button::before{
	color: #000!important;
}
</style>
<script>
$(document).on('click', '.coupon_for', function(){
	if($(this).val() == 1)
	{
		$('.select_course').show();
	}
	else{
		$('.select_course').hide();
	}
});

function validation()
{
	// alert("<?php echo site_url();?>");return false;
	var code = $("#code").val().trim();
	var title = $("#title").val().trim();
	var typediscount = document.getElementsByName("typediscount");
	var discount = $("#discount").val().trim();
	var codestart = $("#codestart").val().trim();
	var endpublish = $("#endpublish").val().trim();

	if(code=="")
	{
		$("#err_code").fadeIn().html("Please enter Coupon code").css('color','red');
        setTimeout(function(){$("#err_code").html("&nbsp;");},3000);
        $("#code").focus();
        return false;
    }
    else
    {
    	$.ajax({
        type:"POST",
        cache:false,
        url:"<?php echo base_url();?>/admin/promocodes/check_exists",
        data:{
          code:code
        },
        success:function(returndata)
        {
          if(returndata==1)
          {
            $("#err_code").fadeIn().html("This coupon already exists").css('color','red');
            setTimeout(function(){$("#err_code").html("&nbsp;");},3000);
            $("#code").focus();
            return false;
          }
          else
          {
          	return true;
          }
        }
      });
    }

    if(title=="")
	{
		$("#err_description").fadeIn().html("Please enter offer description").css('color','red');
        setTimeout(function(){$("#err_description").html("&nbsp;");},3000);
        $("#title").focus();
        return false;
    }

	if(typediscount[1].checked)
    {
	    if(discount=="" || discount==0)
		{
			$("#err_discount").fadeIn().html("Please enter discount rate").css('color','red');
	        setTimeout(function(){$("#err_discount").html("&nbsp;");},3000);
	        $("#discount").focus();
	        return false;
	    }
	    if(discount>=100)
		{
			$("#err_discount").fadeIn().html("discount should less than 100").css('color','red');
	        setTimeout(function(){$("#err_discount").html("&nbsp;");},3000);
	        $("#discount").focus();
	        $("#discount").val("0");
	        return false;
	    }
	}
	else
	{
		if(discount=="" || discount==0)
		{
			$("#err_discount").fadeIn().html("Please enter discount amount").css('color','red');
	        setTimeout(function(){$("#err_discount").html("&nbsp;");},3000);
	        $("#discount").focus();
	        return false;
	    }
	}
    
    if(codestart=="")
	{
		$("#err_from").fadeIn().html("Please enter coupon valid from").css('color','red');
        setTimeout(function(){$("#err_from").html("&nbsp;");},3000);
        $("#codestart").focus();
        return false;
    }

    if(endpublish=="")
	{
		$("#err_to").fadeIn().html("Please enter Coupon valid till").css('color','red');
        setTimeout(function(){$("#err_to").html("&nbsp;");},3000);
        $("#endpublish").focus();
        return false;
    }
}
</script>