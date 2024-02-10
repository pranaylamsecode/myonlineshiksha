<div id="content-top">
    <h2><?=lang('web_category_list')?></h2>
    <a href='<?php echo base_url(); ?>/admin/categories/create/<?=$this->uri->segment(3)?>' class='bcreate'><?=lang('web_add_category')?></a>
    <span class="clearFix">&nbsp;</span>
    <?php


if ($category_id){

	$nav_home =  "<a href='".base_url()."/admin/categories/'>".lang('web_home')."</a> &nbsp;&nbsp;>&nbsp;&nbsp; ";
	$nav =  $category->name;
	
	while(! is_null($category->category ) )
	{
		$nav = "<a href='".base_url()."/admin/categories/".$category->category->id."'>".$category->category->name . "</a> &nbsp;&nbsp;>&nbsp;&nbsp; ". $nav; 

		$category = $category->category;
	}

	echo "<div id='nav_categories'>$nav_home $nav</div>";
}
?>
</div>

<div class='clear'></div>


<?php if ($categories): ?>

	<table id='tcategories' class='ftable' cellpadding="5" cellspacing="5">

		<thead>
			<th></th>
			<th><?=lang('web_name')?></th>
			<th>Productos</th>
			<th colspan='2'><?=lang('web_options')?></th>
		</thead>

		<tbody>
			<tr>
				<td>
					<table width="100%">
				<tbody>
					<tr>
						<td width="70%" valign="top">
			
						<ul id="dhtmlgoodies_tree2" class="dhtmlgoodies_tree">
							<li id="node0" norename="true" nodelete="true" nosiblings="true" nodrag="true" style="list-style-type:none;">
							<span style="margin-top: -10px; color: black; font-family:Arial,Helvetica,sans-serif; font-size:17px;"><b>Modulename</b></span>
							<a href="#" >(Add new module)</a>
							<br>
							<?php //if ($days): ?>	
								<ul>
								<?php //foreach ($days as $day): ?>
									<li id="node1" leafid="5" isleaf="false" style="background:url(components/com_guru/images/join_dot.png) repeat-y">
									<a href="#"><?php //echo $day->title;?></a>
									</li>
								<?php //endforeach;?>
								</ul>
							<?php //else: ?>
								<p class='text'><?=lang('web_no_elements');?></p>
							<?php //endif ?>
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
		</tbody>

	</table>

<?php else: ?>

	<p class='text'><?=lang('web_no_elements');?></p>

<?php endif ?>