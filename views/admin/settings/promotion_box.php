<script type="text/javascript">
	jQuery(document).ready(
		function()
		{
			jQuery('#content_selling').redactor();
		}
	);
</script>
<?php
$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/promotionbox', $attributes) : form_open_multipart(base_url().'admin/settings/promotionbox');

?>
<div id="toolbar-box">


	<div class="m">


		<div id="toolbar" class="toolbar-list">


			

			<div class="clr"></div>


		</div>


		<div class="pagetitle icon-48-generic"><h2><?php echo 'Promotion Box Settings';?></h2></div>


	</div>


</div>





<p><strong>Content for the 'No Access' promotion box</strong></p>


	<div style="margin-bottom:10px;">Here you can edit the content of the promotion box your visitors see when they click on a lesson they don't have access to.</div>


<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Promotion Box Settings
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				
				<form role="form" class="form-horizontal form-groups-bordered">
	
					 <?php //$this->ckeditor->editor("content_selling",$content_selling);?>
					<textarea name="content_selling" id="content_selling" class="form-control" rows="6" placeholder="Description"><?php echo $content_selling;?></textarea>

					<?php echo form_error('description'); ?> 
                    
                    
                    <br />
                    <br />
					
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">			
						<a>
							<?php echo form_submit( 'submit', "Save","id='submit' class='btn btn-default'"); ?>
						</a>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>



   


    <input type="hidden" value="1" name="id">





<?php echo form_close(); ?>