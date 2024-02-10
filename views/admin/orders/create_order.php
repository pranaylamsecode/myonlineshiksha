<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style type="text/css">
select#user_id, select#course_id {
    display: none !important;
}
.dropdown-select {
    background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0) 100%);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#40FFFFFF', endColorstr='#00FFFFFF', GradientType=0);
    background-color: #fff;
    border-radius: 6px;
    border: solid 1px #eee;
    box-shadow: 0px 2px 5px 0px rgba(155, 155, 155, 0.5);
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    float: left;
    font-size: 14px;
    font-weight: normal;
    height: 42px;
    line-height: 40px;
    outline: none;
    padding-left: 18px;
    padding-right: 30px;
    position: relative;
    text-align: left !important;
    transition: all 0.2s ease-in-out;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    white-space: nowrap;
    width: auto;

}
.dropdown-select:focus {
    background-color: #fff;
}
.dropdown-select:hover {
    background-color: #fff;
}
.dropdown-select:active,
.dropdown-select.open {
    background-color: #fff !important;
    border-color: #bbb;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05) inset;
}
.dropdown-select:after {
    height: 0;
    width: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 4px solid #777;
    -webkit-transform: origin(50% 20%);
    transform: origin(50% 20%);
    transition: all 0.125s ease-in-out;
    content: '';
    display: block;
    margin-top: -2px;
    pointer-events: none;
    position: absolute;
    right: 10px;
    top: 50%;
}
.dropdown-select.open:after {
    -webkit-transform: rotate(-180deg);
    transform: rotate(-180deg);
}
.dropdown-select.open .list {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
    pointer-events: auto;
}
.dropdown-select.open .option {
    cursor: pointer;
}
.dropdown-select.wide {
    width: 100%;
}
.dropdown-select.wide .list {
    left: 0 !important;
    right: 0 !important;
}
.dropdown-select .list {
    box-sizing: border-box;
    transition: all 0.15s cubic-bezier(0.25, 0, 0.25, 1.75), opacity 0.1s linear;
    -webkit-transform: scale(0.75);
    transform: scale(0.75);
    -webkit-transform-origin: 50% 0;
    transform-origin: 50% 0;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.09);
    background-color: #fff;
    border-radius: 6px;
    margin-top: 4px;
    padding: 3px 0;
    opacity: 0;
    overflow: hidden;
    pointer-events: none;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 999;
    max-height: 250px;
    overflow: auto;
    border: 1px solid #ddd;
}
.dropdown-select .list:hover .option:not(:hover) {
    background-color: transparent !important;
}
.dropdown-select .dd-search{
  overflow:hidden;
  display:flex;
  align-items:center;
  justify-content:center;
  margin:0.5rem;
}
.dropdown-select .dd-searchbox{
  width:90%;
  padding:0.5rem;
  border:1px solid #999;
  border-color:#999;
  border-radius:4px;
  outline:none;
}
.dropdown-select .dd-searchbox:focus{
  border-color:#12CBC4;
}
.dropdown-select .list ul {
    padding: 0;
}
.dropdown-select .option {
    cursor: default;
    font-weight: 400;
    line-height: 40px;
    outline: none;
    padding-left: 18px;
    padding-right: 29px;
    text-align: left;
    transition: all 0.2s;
    list-style: none;
}
.dropdown-select .option:hover,
.dropdown-select .option:focus {
    background-color: #f6f6f6 !important;
}
.dropdown-select .option.selected {
    font-weight: 600;
    color: #12cbc4;
}
.dropdown-select .option.selected:focus {
    background: #f6f6f6;
}
.dropdown-select a {
    color: #aaa;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
}
.dropdown-select a:hover {
    color: #666;
}
</style>
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

			ftpfileoptions = '<img src="<?php echo base_url() ?>public/uploads/users/img/thumbs/'+data.ftpfilearray+'">';

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

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>

// $(function() {    $( document ).tooltip();  });

</script>



<?php

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/orders/create', $attributes) : form_open_multipart(base_url().'admin/orders/edit/'.$id, $attributes);

?>


<div class="main-container">
	<div id="toolbar-box">
  <div class="m">
    <div class="pagetitle icon-48-generic"><h2><?php echo (($updType == 'edit')?'Edit Order':'Create Order');?></h2>
    	<h6>This will allow you to manage the order. On update, it will send an email confirmation to the user.</h6>
    </div>
  </div>
</div>

<div class="field_container">

<div class="row">
				
				<form role="form" class="form-horizontal form-groups-bordered">

                    
					<div class="form-group form-border">
						<label class="col-sm-12 control-label field-title">User Name<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12 main-user">		                           
                            <select name='user_id' id='user_id' class="form-control form-height select2-content" <?php if(@$order) echo 'disabled'; ?> >
                                <option value="">Select</option>  									           
                                <?php								   
								foreach($username as $usernm)
								{
									?>
									<option value="<?php echo $usernm->id;?>" <?php echo ($this->input->post('user_id') == $usernm->id) ? "selected=selected" : (isset($order->userid)) && @$order->userid == $usernm->id ? "selected=selected" : '' ?>><?php echo $usernm->first_name.' '.$usernm->last_name;?></option>
									<?php 
								}
								?>
	                        </select>
	                        <span class="error"><?php echo form_error('user_id'); ?></span>
	                    <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">
						<span type="text" id="uname-target" class="tooltipicon"></span>
						<span class="uname-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('order_fld_umane');?>
                         
						</span>
						</span>  -->            

<!-- tooltip area finish -->
						</div>
					</div>                    
                                       
                    <div class="clear"></div>
                    
                    <div class="form-group form-border" style="padding-top: 0!important;">
						<label class="col-sm-12 control-label field-title">Course<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12 main-course">                     
                            <select onchange="return get_batch(this.value);" name='course_id' id='course_id' class="form-control form-height select2-content" <?php if(@$order) echo 'disabled'; ?>>
                                <option value=" ">Select</option>  									           
                                <?php foreach($courses as $course){ ?>
								<option value="<?php echo $course->id;?>" <?php echo ($this->input->post('course_id') == $course->id) ? "selected=selected" : (isset($order->courses)) && @$order->courses == $course->id ? "selected=selected" : '' ?>><?php echo $course->name;?></option>
								<?php } ?>
							</select>
							<span class='error'><?php echo form_error('course_id'); ?></span>
						</div>
					</div>					
                 					
					<div class="clear"></div>
                    
                    <div class="form-group form-border" style="padding-top: 0!important;">
						<label class="col-sm-12 control-label field-title">Batch</label>
						
						<div class="col-sm-12">                     
                            <select name='batch_id' id='batch_id' class="form-control form-height">
                                <option value="">Select</option>
							</select>
						</div>
					</div>					
                 					
					<div class="clear"></div>
                    
                    <div class="form-group form-border" style="padding-top: 0!important;">
						<label for="Price" class="col-sm-12 control-label field-title">Price</label>
						
						<div class="col-sm-12">
						<?php
								// $price = $this->users_model->getPrice(@$order->courses);	
						$price = '';
						if(!empty($order))
							$price = $this->Crud_model->get_single('mlms_program',"id = ".$order->courses,"fixedrate");
						?>
                        <input id="price" class="form-control form-height" placeholder="Enter Price" type="text" name="price" maxlength="256" value="<?php echo ($this->input->post('price')) ? $this->input->post('price') : ((isset($price)) ? $price->fixedrate : '0');?>"  <?php if(@$order) echo 'readonly'; ?> />
						<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="price-target" class="tooltipicon"></span>

						<span class="price-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

						

						<?php echo lang('order_fld_price');?>

                         

						</span>

						</span> -->

                        <?php echo form_error('last_name'); ?>

<!-- tooltip area finish -->
                            
						</div>
					</div>				
                    
                    		
					
                    <div class="clear"></div>
                    
					<div class="form-group form-border">
						<label class="col-sm-12 control-label field-title">Status<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">                           
                            <select onchange="javascript:showhidefields(this.selectedIndex)" name='status_id' id='status_id' class="form-control form-height">
                                <option value=" ">Select</option>  
								<option value="SUCCESS" <?php echo ($this->input->post('status_id') == 'SUCCESS') ? "selected=selected" : (isset($order->status)) && @$order->status == 'SUCCESS' ? "selected=selected" : '' ?> >SUCCESS</option>
					            <option value="PENDING" <?php echo ($this->input->post('status_id') == 'PENDING') ? "selected=selected" : (isset($order->status)) && @$order->status == 'PENDING' ? "selected=selected" : '' ?> >PENDING</option>
					            <option value="FAILURE" <?php echo ($this->input->post('status_id') == 'FAILURE') ? "selected=selected" : (isset($order->status)) && @$order->status == 'FAILURE' ? "selected=selected" : '' ?> >FAILURE</option>                    
			                </select>
			                <span class='error'><?php echo form_error('status_id'); ?></span>
			            <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="status-target" class="tooltipicon"></span>

						<span class="status-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('order_fld_status');?>

                       

						</span>

						</span> -->
						<!-- tooltip area finish -->
						</div>
					</div>
					 
                    
                    <div class="clear"></div>
                    
                    <div class="form-group form-border" style="padding-top: 0!important;">
						<label for="pending_reason" class="col-sm-12 control-label field-title">Pending Reason</label>
						
						<div class="col-sm-12">                          
	                        <input id="pending_reason" class="form-control form-height" placeholder="Enter Pending Reason" type="text" name="pending_reason" maxlength="256" value="<?php echo ($this->input->post('pending_reason')) ? $this->input->post('pending_reason') : ((isset($order->pending_reason)) ? $order->pending_reason : '');?>"  <?php if(@$order) echo 'readonly'; ?> />
							<!-- tooltip area -->
							<!-- <span class="tooltipcontainer">
							<span type="text" id="pending-target" class="tooltipicon"></span>
							<span class="pending-target  tooltargetdiv" style="display: none;" >
							<span class="closetooltip"></span>
							
							<?php echo lang('order_fld_pending');?>
	                         
							</span>
							</span> -->
							<!-- tooltip area finish -->
						</div>
					</div>
                    
                    
                    <div class="clear"></div>
					
                    <div class="form-group form-border">
						<label for="Amount" class="col-sm-12 control-label field-title">Amount</label>
						
						<div class="col-sm-12">
                            
                        <input id="amount" type="text" name="amount"  class="form-control form-height" placeholder="Enter Amont" maxlength="256" value="<?php echo ($this->input->post('amount')) ? $this->input->post('amount') : ((isset($order->amount_paid)) ? $order->amount_paid : '');?>"  <?php if(@$order) echo 'readonly'; ?>/>
                        
                        <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="amount-target" class="tooltipicon"></span>

						<span class="amount-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('order_fld_amount');?>

                         

						</span>

						</span> -->

						<!-- tooltip area finish -->

						</div>
					</div>
                    
                    
                    
                    <div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="Processor" class="col-sm-12 field-title control-label">Processor <span style="color:#FF0000;" class="error">*</span>
						<p>Name of the channel through which you have received the payment.</p>
						</label>
						
						<div class="col-sm-12">
							
                        <input id="processor" class="form-control form-height" placeholder="Enter Processor" type="text" name="processor" maxlength="256" value="<?php echo set_value('processor', (isset($order->processor)) ? $order->processor : ''); ?>"  <?php if(@$order) echo 'readonly'; ?> />
						<span class='error'><?php echo form_error('processor'); ?></span>
						<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="processor-target" class="tooltipicon"></span>

						<span class="processor-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

						

						<?php echo lang('order_fld_processor');?>

                         

						</span>

						</span>    -->                    

						<!-- tooltip area finish -->
                            
						</div>
					</div>
					
					
                    <!-- new code start here @@@@@@@@@@@@@@@@@@@@@@-->

                    <div class="form-group form-border" style="padding-top: 0!important;">
						<label for="Processor" class="col-sm-12 control-label field-title">Note <span style="color:#FF0000;" class="error"></span></label>
						
						<div class="col-sm-12">
							
                            <textarea id="note" name="note" class="form-control select-box-border" placeholder="Enter Note"><?php echo ($this->input->post('note')) ? $this->input->post('note') : ((isset($order->note)) ? $order->note : '');?></textarea>


<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="note-target" class="tooltipicon"></span>

						<span class="note-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

						

						<?php echo "Enter Notes";?>

                         

						</span>

						</span> -->

                        <?php echo form_error('last_name'); ?>

<!-- tooltip area finish -->
                            
						</div>
					</div>
					
                    <!-- new code end here @@@@@@@@@@@@@@@@@@@@ -->
					<div class="clear"></div>
                    
					<div class="form-group form-border" style="">
						
                        <div class="col-sm-5">
						   
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Update" : "Update", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?>
            
            <a href='<?php echo base_url() ?>admin/orders/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</form>
				
			</div>
	</div>
</div>

 <link rel="stylesheet" href="<?php echo base_url() ?>js/redactor/css/redactor.css" />

<script src="<?php echo base_url() ?>js/redactor/redactor.js"></script>

<script type="text/javascript">
	var $ =jQuery.noConflict();
	function create_custom_dropdowns() {
    $('.select2-content').each(function (i, select) {
        if (!$(this).next().hasClass('dropdown-select')) {
            $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
            var dropdown = $(this).next();
            var options = $(select).find('option');
            var selected = $(this).find('option:selected');
            dropdown.find('.current').html(selected.data('display-text') || selected.text());
            options.each(function (j, o) {
                var display = $(o).data('display-text') || '';
                dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
            });
        }
    });
    $('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" class="dd-searchbox" type="text"></div>');
    // $('.main-course .dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue1" autocomplete="off"  class="dd-searchbox" type="text"></div>');
}

// Event listeners

// Open/close
$(document).on('click', '.dropdown-select', function (event) {
    if($(event.target).hasClass('dd-searchbox')){
        return;
    }
    $('.dropdown-select').not($(this)).removeClass('open');
    $(this).toggleClass('open');
    if ($(this).hasClass('open')) {
        $(this).find('.option').attr('tabindex', 0);
        $(this).find('.selected').focus();
    } else {
        $(this).find('.option').removeAttr('tabindex');
        $(this).focus();
    }
});

// Close when clicking outside
$(document).on('click', function (event) {
    if ($(event.target).closest('.dropdown-select').length === 0) {
        $('.dropdown-select').removeClass('open');
        $('.dropdown-select .option').removeAttr('tabindex');
    }
    event.stopPropagation();
});

/*function filter(){
    var valThis = $('#txtSearchValue').val();
    $('.main-user .dropdown-select ul > li').each(function(){
     var text = $(this).text();
        (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();         
   });
};
function filter1(){
    var valThis = $('#txtSearchValue1').val();
    $('.main-course .dropdown-select ul > li').each(function(){
     var text = $(this).text();
        (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();         
   });
};*/

// Search

// Option click
$(document).on('click', '.dropdown-select .option', function (event) {
    $(this).closest('.list').find('.selected').removeClass('selected');
    $(this).addClass('selected');
    var text = $(this).data('display-text') || $(this).text();
    $(this).closest('.dropdown-select').find('.current').text(text);
    $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
});

// Keyboard events
$(document).on('keydown', '.dropdown-select', function (event) {
    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
    // Space or Enter
    //if (event.keyCode == 32 || event.keyCode == 13) {
    if (event.keyCode == 13) {
        if ($(this).hasClass('open')) {
            focused_option.trigger('click');
        } else {
            $(this).trigger('click');
        }
        return false;
        // Down
    } else if (event.keyCode == 40) {
        if (!$(this).hasClass('open')) {
            $(this).trigger('click');
        } else {
            focused_option.next().focus();
        }
        return false;
        // Up
    } else if (event.keyCode == 38) {
        if (!$(this).hasClass('open')) {
            $(this).trigger('click');
        } else {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            focused_option.prev().focus();
        }
        return false;
        // Esc
    } else if (event.keyCode == 27) {
        if ($(this).hasClass('open')) {
            $(this).trigger('click');
        }
        return false;
    }
});

$(document).ready(function () {
    create_custom_dropdowns();
    $(".dd-searchbox").each(function(){
		$(this).keyup(function(){
			var valThis = $(this).val();
		    $(this).parent().parent().find('ul > li').each(function(){
		     var text = $(this).text();
		        (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();         
		   });
		});
	});
});
</script>

<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$order->id); ?>

<?php endif ?>

<?php echo form_close(); ?>



<!-- tool tip script -->

<script type="text/javascript">

//$(document).ready(function(){

//	$('.tooltipicon').click(function(){

//	var dispdiv = $(this).attr('id');

//	$('.'+dispdiv).css('display','inline-block');

//	});

//	$('.closetooltip').click(function(){

//	$(this).parent().css('display','none');

//	});

//	});

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

	function get_batch(id){
		if(id != ''){
			// alert(id);return false;
			$.ajax({
				type : "post",
				cache : false,
				url : "<?php echo base_url();?>admin/orders/get_batch/",
				data: {id : id},
				success : function(res){
					$('#batch_id').html(res);
				}
			});
		}
	}
</script>

<!-- tool tip script finish -->