<div id="content-top">
    <h2><?php echo 'Programs Moduls'; //echo lang('web_category_list')?></h2>
    <a href='<?php echo base_url(); ?>/admin/days/create/<?php echo $this->uri->segment(3)?>' class='bcreate'><?echo lang('web_add_category')?></a>
    <span class="clearFix">&nbsp;</span>
    <?php
	if ($this->uri->segment(3)){
	$nav_home =  "<a href='".base_url()."/admin/coursecategories/'>".lang('web_home')."</a> &nbsp;&nbsp;>&nbsp;&nbsp; ";
	$nav =  $program->name;
	//while(! is_null($program->name ) )	//{
		$nav = "<a href='".base_url()."/admin/days/".$program->id."'>".$program->name . "</a>"; 
		//$category = $category->category;
	//}
	echo "<div id='nav_categories'>$nav_home $nav</div>";}?></div><div class='clear'></div>
<?php //if ($days): ?>
	<table id='tcategories' class='ftable' cellpadding="5" cellspacing="5">		<thead>
			<th></th>		</thead>		<tbody>			<?php //foreach ($categories as $category): ?>				<tr id='<?php //$category->id?>'>					<td valign='middle'>					<table width="100%">				<tbody>					<tr>						<td width="70%" valign="top">						<?php 
						$num=0;
						$node=0;?>
						<ul id="dhtmlgoodies_tree2" class="dhtmlgoodies_tree">
							<li id="node<?php echo $node;?>" norename="true" nodelete="true" nosiblings="true" nodrag="true" style="list-style-type:none;">
							<span style="margin-top: -10px; color: black; font-family:Arial,Helvetica,sans-serif; font-size:17px;"><b><?php echo $program->name;?></b></span>
							<a href='<?php echo base_url(); ?>/admin/days/create/<?php echo $this->uri->segment(3)?>' class='bcreate'>(Add new module)</a>
							<br>
							<?php if ($days): ?>	
								<ul id="tree_ul_<?php echo $num;?>">
								<?php 
								foreach ($days as $day): 
								$num++;
								?>
									<li id="node<?php echo $node;?>" leafid="5" isleaf="false" style="background:url(components/com_guru/images/join_dot.png) repeat-y">
									<a href="<?php echo base_url(); ?>/admin/days/edit/<?php echo $day->id;?>/<?php echo $program->id;?>"><?php echo $day->title;?></a>
									<a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>/admin/days/delete/<?php echo $day->id?>/<?php echo $this->uri->segment(3)?>'>&nbsp;</a>
									<a href='<?php echo base_url(); ?>/admin/days/create/<?php echo $this->uri->segment(3)?>' class='create'>(Add new lesson)</a>
										<ul id="tree_ul_<?php echo $num;?>">
											<?php 
											$lessons = $this->days_model->getLessons($day->id);
											if ($lessons):
											foreach ($lessons as $lesson): 
											$node++;
											?>
											<li id="node<?php echo $node;?>" leafid="1" isleaf="true">
											<a id="nodeATag2" class="modal" href="index.php?option=com_guru&controller=guruTasks&tmpl=component&task=editsbox&cid[]=1&progrid=1&module=1" rel="{handler: 'iframe', size: {x: 935, y: 550}}">
											<?php echo $lesson->name;?></a>
											</li>
											<?php endforeach?>
											<?php endif ?>
										</ul>
									</li>
								<?php endforeach?>
								</ul>
							<?php else: ?>
								<p class='text'><?=lang('web_no_elements');?></p>
							<?php endif ?>
							</li>
						</ul>
			
						</td>
						<td valign="top" align="right">
							<table width="100%">
								<tbody><tr>
									<td align="right">
										<a href="index.php?option=com_guru&amp;controller=guruAbout&amp;task=vimeo&amp;id=27181365&amp;tmpl=component" rel="{handler: 'iframe', size: {x: 745, y: 430}}" class="modal guru_video">
											<img class="video_img" src="http://localhost/Joomla_2.5.8/administrator/components/com_guru/images/icon_video.gif">
											Video Tutorial: Adding a table of content                  
										</a>
									</td>
								</tr>
								<tr>	
									<td align="right">
										<a style="display:none;" id="close_gb">#</a>
									
										<a href="index.php?option=com_guru&amp;controller=guruAbout&amp;task=vimeo&amp;id=30058444&amp;tmpl=component" rel="{handler: 'iframe', size: {x: 745, y: 430}}" class="modal guru_video">
											<img class="video_img" src="http://localhost/Joomla_2.5.8/administrator/components/com_guru/images/icon_video.gif">
											Video Tutorial: Adding a lesson                  
										</a>
									</td>
								</tr>
							</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
					</td>
					
				</tr>
				
			<?php //endforeach ?>
		</tbody>

	</table>

<?php //else: ?>

	<!--<p class='text'><?=lang('web_no_elements');?></p>-->

<?php //endif ?>