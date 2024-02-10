

<style>



.error{
	color: red;
	font-size:13px;
	display: none;
}

.redactor-editor {
  min-width: 0px!important; 
}
.main-table {
  display: block!important;
  width: 100%!important;
}
</style>

<div class="main-container">
<?php

$attributes = array('class' => 'tform', 'id' => 'chapter');

echo ($updType == 'create') ? form_open(base_url().'admin/days/create', $attributes) : form_open(base_url().'admin/days/edit_popup/'.$day->id.'/'.$day->pid, $attributes);

?>


<div class="field_container">
<div class="col-sm-12">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
<div class="panel primary-border panel-primary" data-collapsed="0">
	
<div class="panel-body form-body main-table">
				
				<fieldset class="adminform form-horizontal form-groups-bordered" style="width:100%;">	
				
                    <div class="form-group form-border">
                    
                    <label class='col-sm-12 field-title control-label' for="title"><?php echo 'Title'//echo lang('web_name')?> <span class="required">*</span></label>

										
					    <div class="col-sm-12">							
							<input id="title" type="text" name="title" class="form-control form-height" maxlength="256" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : ((isset($day->title)) ? $day->title : ''); ?>" />


                        <span class="error"><?php echo form_error('title'); ?> </span>

					<!-- tooltip area finish -->
						</div>
						
					</div>
                    
                    <div class="form-group no-padding form-border">
                    <div class="col-sm-12">
                   <div class="grey-background grey-background-display">
                    <label class='control-label'><?//=lang('web_active')?></label>
                    
                    	<div class="col-sm-12 no-padding">
                   

	<input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == 1) ? 'checked' : ((isset($day->published) && $day->published == 1) ? 'checked' : ''); ?> <?php echo ($updType == 'create')? 'checked':'';?>/>


  <label class='control-label dark_label' for='active'> Publish </label>





	<?php echo form_error('published'); ?>
                    	</div>
                    </div>
                    </div>
                    </div>

					
					</fieldset>
                    
      </div>
  </div>
</div>

	<ul id="sticky" class="main-content-btn" style="list-style: none; float: right;">



            <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
				<?php 
				//echo form_button( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'") ); 
				?>			
				<!-- <input type="submit" id='submit' name='submit' value='Save' class='btn btn-success btn-blue'> -->
                <input type="button" onclick="submit_form()" id='submit' name='submit' value='Save' class='btn btn-success btn-blue'>
			</li>
			
			<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



			<a href='#' class='btn btn-danger btn-dark-grey cross_icon' id="forward" style="color:#FFF;">Cancel</a>



			</li>            



			</ul>



	<?php echo form_hidden('parent_id',$parent_id) ?>	







<?php if ($updType == 'edit'): ?>

<input type="hidden" name="updType" value="<?php echo $updType ?>">

	<?php echo form_hidden('id',$day->id) ?>



<?php endif ?>


	
</div>
</div>


<?php echo form_close(); ?>


<script>
    function submit_form(){
        var updType = "<?php echo $updType ?>";
            if(updType=='edit')
                var url = "<?php echo base_url()?>admin/days/edit_popup/<?php echo $parent_id ?>/<?php echo $day->id ?>";
            else
                var url = "<?php echo base_url()?>admin/days/edit_popup/<?php echo $parent_id ?>";
    $.ajax({
        type: "POST",
        url: url,
dataType: "json",
data: $("#chapter").serialize(),
// var optionsignin2 = { 
    beforeSend: function() 
    {
    	if($('#title').val()=='')
    	{
    		    		// $('#title').append('<span class="error">Please enter title</span> ');

    		$('.error').text('Please enter title');
    		$('.error').show();
    		$('.error').fadeIn().delay(1000).fadeOut();
    		
    		return false;
    	}
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
        
 
    },
    success: function() 
    {
    
    },
    complete: function(response) 
    {  
        if(response){
        	var updType = "<?php echo $updType ?>";
        	if(updType=='edit'){
        		var msg = "Chapter Successfully Edited";
                var obj = response.responseJSON;

                $(document).find('#s_'+obj.did).find('.chap_title').html('<h4>'+obj.title+'</h4>');
            }
        	else {
                var msg = "Chapter Successfully Created";
                var obj = response.responseJSON;
                console.log(obj);
                 var str = '<li class="dd-item main-table" id="s_'+obj.did+'"><div class="col-sm-1 orange-bg"><div class="col-sm-12 no-padding top-menu-icon"><a href="#chapter" class="add_chapter edit" id="edit_'+obj.did+'_'+obj.pid+'" title="Edit Chapter"><div class="sprite 8menu" style="background-position: -216px 0; height: 18px;" title="Course Menu"></div></a></div><div class="col-sm-12 no-padding bottom-close-icon"><a style="cursor:pointer" onclick="return deleteconfirm('+obj.did+','+obj.pid+')"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a></div></div><div class="col-sm-11 dd-content no-left-padding light-grey-bg"><div class="col-sm-12 chap_title"><h4>'+obj.title+'</h4></div><ul class="dd-list left-padding sortable sortableconnect ui-sortable" id="'+obj.did+'"></ul><div class="col-sm-12 bottom-sect"><a style="cursor:pointer" href="#lecture" class="sect inline-position add_lecture create" id="lecture_'+obj.did+'_'+obj.pid+'"><div style="margin-right: 6%;" title="Add New" class=""><img src="<?php echo base_url() ?>public/css/image/plus-green.png"></div><p style="padding-top: 2%;">Add Lecture</p></a>  <a style="cursor:pointer" class="add_quiz sect inline-position" id="quiz_'+obj.did+'_'+obj.pid+'"><div style="margin-right: 6%;" title="Add New" class=""><i class="fas fa-plus add_icon add_exam_icon"></i></div><p style="padding-top: 2%;">Add Quiz</p></a></div></div></li>';

                $(document).find('#list-2').find('ul.main-sect').append(str);

            }

    		//      	$.alert({
        	
    		//     title: msg,
    		//     content: ' ',
    		// });
            var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+msg+' </div>';
             var note = $(document).find('#message');
              note.html(str);
            note.show();
            note.fadeIn().delay(3000).fadeOut();
        }
        else{
            if(updType=='edit')
                var msg = "Fail to edit Chapter";
            else var msg = "Fail to create Chapter";
            // $.alert({
            
            //     title: msg,
            //     content: ' ',
            // });
             var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+msg+' </div>';
             var note = $(document).find('#message');
              note.html(str);
            note.show();
            note.fadeIn().delay(3000).fadeOut();
            // $('#lecture_save').prop('disabled', false);
        }

         $('.course_popup').hide(); 
       $('.popup_overlay_lec').hide()
    },
    error: function()
    {   
      alert('error');
       
 
    }
 
}); 
}
 
// $("#chapter").ajaxForm(optionsignin2);

</script>