<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function() {
	   jQuery('#add_button').click(function() {
	  
	     jQuery('#desig_field,#details_field').toggle();
	   
	   });	
	});
</script>

<script type="text/javascript">
	jQuery(document).ready(function() {
	    jQuery('#group_id').on('change',function() {
	   
		 var indexid = jQuery("#group_id").val();
		 
		 if(indexid == 2)
		 {
	      jQuery('#payment_field').css("display","block"); 
		  
		  jQuery('#payment_mode').on('change',function() {
		     
	      var pay_val = jQuery("#payment_mode").val();
		  
		  if(pay_val == "salary" || pay_val == "percent")
		  {
		  
		  jQuery('#payment_type').css("display","block");
		  
		  }
		  else {
		     jQuery('#payment_type').css("display","none");
		  }
		  
		  } );
		 }
		 else{
		   
		   jQuery('#payment_field').css("display","none");
		 }
	   
	   });
	});
</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
 	$(function() {    $( document ).tooltip();  });
</script>

<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open_multipart('/admin/questions/create', $attributes) : form_open_multipart('/admin/questions/edit/'.$id, $attributes);
?>

<h2><?php echo (($updType == 'edit')?'Edit Question':'Create Question');?></h2>
<div class="row">
	<div class="col-md-12">
		<div>		
				<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" --> 
					<li class="active"><a href="#regular" data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Regular</span></a></li> 
					<li> <a href="#matchthepair" data-toggle="tab"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Match The Pair</span></a></li>
					<li> <a href="#truefalse" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">True/False</span></a></li> 
					<!--<li> <a href="#fillintheblanks" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Fill In The Blanks</span></a></li>-->
					<li> <a href="#multipletype" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Multiple Type</span></a></li>
					<li> <a href="#mediaquestion" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Media Question</span></a></li>
				</ul>

				<div class="tab-content"> 
					<!-- ........................... Regular.............................................. -->
					<div class="tab-pane active" id="regular">
					<form action="<?php echo base_url();?>index.php/admin/questions/create" method='post' name='frmRegular' id='frmRegular'>
						<div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" required />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='regular' />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtQuestion" name="txtQuestion" class="form-control" rows="6" required /></textarea>
							</div>
						</div><br><br><br><br><br><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Score</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtPoints" name="txtPoints" class="form-control" required />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="pool">In Question Pool</label>							
							<div class="col-sm-9">							
	                      		<input type='checkbox' id="chkInpool" name="chkInpool"/>
							</div>
						</div><br><br><br>
					
						<h4>Enter the option for above question</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options</th> <th>Check corrected answer</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt1' id='txtRegOpt1'></td>
									 	<td><input type='checkbox' name='chkReg1' id='chkReg1'></td> 
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt2' id='txtRegOpt2'></td>
									 	<td><input type='checkbox' name='chkReg2' id='chkReg2'></td> 
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt3' id='txtRegOpt3'></td>
									 	<td><input type='checkbox' name='chkReg3' id='chkReg3'></td> 
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt4' id='txtRegOpt4'></td>
									 	<td><input type='checkbox' name='chkReg4' id='chkReg4'></td> 
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt5' id='txtRegOpt5'></td>
									 	<td><input type='checkbox' name='chkReg5' id='chkReg5'></td> 
									</tr>
								</tbody>
							</table> 
						</form>
					</div>

					<!--........................... Match the pairs.............................................. -->
					<div class="tab-pane" id="matchthepair">
						<form action="<?php echo base_url();?>index.php/admin/questions/create" method='post' name='frmMatch' id='frmMatch'>
						<div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='match_the_pair' />
							</div>
						</div><br><br><br>
						
						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="pool">In Question Pool</label>							
							<div class="col-sm-9">							
	                      		<input type='checkbox' id="chkInpool" name="chkInpool"/>
							</div>
						</div><br><br><br>

						<h4>Match the pairs</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Questions</th> <th>Matching pairs (Answers)</th> <th>Score</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class='form-control' name='txtMatchque1' id='txtMatchque1'></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair1' id='txtMatchpair1'></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints1' id='txtMatchpoints1'></td>
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class='form-control' name='txtMatchque2' id='txtMatchque2'></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair2' id='txtMatchpair2'></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints2' id='txtMatchpoints2'></td>
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class='form-control' name='txtMatchque3' id='txtMatchque3'></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair3' id='txtMatchpair3'></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints3' id='txtMatchpoints3'></td>
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class='form-control' name='txtMatchque4' id='txtMatchque4'></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair4' id='txtMatchpair4'></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints4' id='txtMatchpoints4'></td>
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class='form-control' name='txtMatchque5' id='txtMatchque5'></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair5' id='txtMatchpair5'></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints5' id='txtMatchpoints5'></td>
									</tr>
								</tbody>
							</table> 		
						</form>				
				    </div> 

				    <!--........................... True False.............................................. -->
					<div class="tab-pane" id="truefalse"> 
						<form action="<?php echo base_url();?>index.php/admin/questions/create" method='post' name='frmTrueFalse' id='frmTrueFalse'>
						<div class="form-group" style="text-align: right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='true_false' />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtTFQuestion"  name="txtTFQuestion"  class="form-control" rows="6"/></textarea>
							</div>
						</div><br><br><br><br><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Score</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtTFPoints" name="txtTFPoints" class="form-control" />
							</div>
						</div>	<br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Select correct Answer</label>							
							<div class="col-sm-9">							
	                      		<input type='radio' name="rbTrueFalse" value='True'>  True
	                      		<input type='radio' name="rbTrueFalse" value='False'>  False
							</div>
						</div><br><br><br>		
						</form>			
					</div>

					<!--........................... Fill in the blanks.............................................. -->
					<!--<div class="tab-pane" id="fillintheblanks"> 
						<form action="<?php echo base_url();?>index.php/admin/questions/create" method='post' name='frmFill' id='frmFill'>
						<div class="form-group">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"></span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='fill_in_the_blanks' />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question for fill in the blanks</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtFLQuestion"  name="txtFLQuestion"  class="form-control" rows="6"/></textarea>
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" />
							</div>
						</div>						
						
						<h4>Enter the option for above question</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options</th> <th>Check corrected answer</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt1' id='txtFLOpt1'></td>
									 	<td><input type='checkbox' name='chkFL1' id='chkFL1'></td> 
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt2' id='txtFLOpt2'></td>
									 	<td><input type='checkbox' name='chkFL2' id='chkFL2'></td> 
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt3' id='txtFLOpt3'></td>
									 	<td><input type='checkbox' name='chkFL3' id='chkFL3'></td> 
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt4' id='txtFLOpt4'></td>
									 	<td><input type='checkbox' name='chkFL4' id='chkFL4'></td> 
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt5' id='txtFLOpt5'></td>
									 	<td><input type='checkbox' name='chkFL5' id='chkFL5'></td> 
									</tr>
								</tbody>
							</table>
						</form>
					</div>-->

					<!--........................... Multiple Type.............................................. -->
					<div class="tab-pane" id="multipletype"> 
						<form action="<?php echo base_url();?>index.php/admin/questions/create" method='post' name='frmMultiple' id='frmMultiple'>
						<div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='multiple_type' />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question for multiple answers</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtMTQuestion" name="txtMTQuestion" class="form-control" rows="6"/></textarea>
							</div>
						</div><br><br><br><br><br><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" />
							</div>
						</div><br><br><br>	
						
						<h4>Enter the option for above question</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options</th> <th>Check corrected answer</th> <th>Score</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt1' id='txtMultiOpt1'></td>
									 	<td><input type='checkbox' name='chkMulti1' id='chkMulti1'></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints1' id='txtMultiPoints1'></td>
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt2' id='txtMultiOpt2'></td>
									 	<td><input type='checkbox' name='chkMulti2' id='chkMulti2'></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints2' id='txtMultiPoints2'></td>
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt3' id='txtMultiOpt3'></td>
									 	<td><input type='checkbox' name='chkMulti3' id='chkMulti3'></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints3' id='txtMultiPoints3'></td>
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt4' id='txtMultiOpt4'></td>
									 	<td><input type='checkbox' name='chkMulti4' id='chkMulti4'></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints4' id='txtMultiPoints4'></td>
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt5' id='txtMultiOpt5'></td>
									 	<td><input type='checkbox' name='chkMulti5' id='chkMulti5'></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints5' id='txtMultiPoints5'></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>		

					<!--........................... Media Questions.............................................. -->
					<div class="tab-pane" id="mediaquestion"> 
						<form action="<?php echo base_url();?>index.php/admin/questions/create" method='post' name='frmMedia' id='frmMedia'>
						<div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='media_type' />
							</div>
						</div><br><br><br><br>

						<div class="form-group">		
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtMediaQuestion" name="txtMediaQuestion" class="form-control" rows="6"/></textarea>
							</div>
						</div><br><br><br><br><br><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Score</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtPoints" name="txtPoints" class="form-control" required />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" />
							</div>
						</div><br><br><br>

						<div class="form-group">		
							<label class="col-sm-3 control-label" for="question">Select Media</label>							
							<div class="col-sm-9">							
	                      		<input type='file' id="flMedia" name="flMedia" class="form-control" />
							</div>
						</div>
						<br><br><br>
					
							<h4>Enter the option for above question</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options</th> <th>Check corrected answer</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt1' id='txtMediaOpt1'></td>
									 	<td><input type='checkbox' name='chkMedia1' id='chkMedia1'></td> 
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt2' id='txtMediaOpt2'></td>
									 	<td><input type='checkbox' name='chkMedia2' id='chkMedia2'></td> 
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt3' id='txtMediaOpt3'></td>
									 	<td><input type='checkbox' name='chkMedia3' id='chkMedia3'></td> 
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt4' id='txtMediaOpt4'></td>
									 	<td><input type='checkbox' name='chkMedia4' id='chkMedia4'></td> 
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt5' id='txtMediaOpt5'></td>
									 	<td><input type='checkbox' name='chkMedia5' id='chkMedia5'></td> 
									</tr>
								</tbody>
							</table> 
						</form>
					</div>	
		</div>
	
	</div>
</div>

<link rel="stylesheet" href="<?php echo base_url(); ?>/js/redactor/css/redactor.css" />

<script src="<?php echo base_url(); ?>/js/redactor/redactor.js"></script>

<script>
$(document).ready(

 function()

 {

   //	$('#full_bio').redactor();

 }

 );

 </script>



<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$user->id); ?>

<?php endif ?>

<?php echo form_close(); ?>

<style>
.hide{
    
    display:none;
}
</style>

<script>
$('#blah').hide();
$('#remove_id').hide();  
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#file_i").change(function(){
        if( $('#file_i').val()!=""){
            
            $('#remove_id').show();
            $('#blah').show('slow');
            $('#imgname').hide('slow');
      }
        else{ $('#remove_id').hide();$('#blah').hide('slow');}
        readURL(this);
    });

  
    $('#remove_id').click(function(){
          $('#file_i').val('');
          $(this).hide();
          $('#blah').hide('slow');
		  $('#imgname').show('slow');
 $('#blah').attr('src','http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png');
});
</script>



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