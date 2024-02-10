<table width="100%">
		<tbody><tr>
			<td>

	<table width="100%">
		<tbody><tr>
			<td align="left">
				<a href="/Joomla_test/index.php?option=com_guru&amp;view=guruPrograms&amp;task=view&amp;cid=1&amp;Itemid=0" onclick="javascript:closeBox();">
					<img title="Course Home Page" alt="Course Home Page" src="http://localhost/Joomla_test/components/com_guru/images/home.png" style="border:none;">
				</a>
			</td>
						<td align="right">

				 <a href="/Joomla_test/index.php?option=com_guru&amp;view=guruTasks&amp;catid=1&amp;task=view&amp;module=1&amp;action=viewmodule">
							<img title="Previous Lesson" alt="Previous Lesson" src="http://localhost/Joomla_test/components/com_guru/images/back.png" style="border:none;">
				 </a>

				<a onclick="window.location.reload();">
					<img title="Refresh Page" alt="Refresh Page" src="http://localhost/Joomla_test/components/com_guru/images/repeat.png" style="border:none;">
				</a>

										<a class="modal" href="/Joomla_test/index.php?option=com_guru&amp;view=guruEditplans&amp;course_id=1&amp;tmpl=component" rel="{handler: 'iframe', size: {x: 400, y: 400}}">
							<img title="Next Lesson" alt="Next Lesson" src="http://localhost/Joomla_test/components/com_guru/images/next.png" style="border:none;">
						</a>
							</td>
		</tr>
						<tr>
					<td></td>
					<td align="right">
						<span style="font-style:italic;">
						Module 1/5, Lesson 1/3						</span>
						<br>
						<div style="width:200px; height:10px; background-color:#990000;" id="blank">
							<div style="float:left; height:10px; width:61.666666666667px; background-color:#339900;" id="completed">
								&nbsp;
							</div>
							<div style="float:left; width:5px; height:10px; background-color:#FFCC00;" id="separator">
						</div>
					</div></td>
				</tr>
			</tbody></table>

		</td>
	</tr>
	<tr>
		<td>

	<table>
		<tbody><tr>
			<td class="contentheading">
           <?php //print_r($lesson); ?>
				<h1><?php echo $lesson->name; ?></h1>			</td>
		</tr>
	</tbody></table>

		</td>
	</tr>
	<tr>
		<td>


			<table cellspacing="0" cellpadding="0" style="width:100%;">
						<tbody><tr style="display:block;" id="layout6">
				<td>
					<table>
						<tbody><tr>
							<td valign="top">
								<table>
									<tbody><tr>
										<td>
											<div id="media_7">
												<div style="text-align:center"><i></i></div>
                                                <?php
                                                echo $lessoncontent->code;
                                                 echo $lessoncontent->url;
                                                 echo $lessoncontent->local;   
                                                 ?>   									</div>
										</td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
									</tbody></table>

			</td>
		</tr>
	</tbody></table>