
<div class="center880">

<form id="tickets" method="post">
<!-- Start Table -->
	<div class="stbox chat1">
		<h1 class="lih1"><?php echo "Blogs"; ?></h1>

		
		<table width="100%" class="tablelist">
			<thead>
				<td width="20%"><?php echo "Title"; ?></td>
				<td width="20%"><?php echo "Status"; ?></td>
				<td width="20%"><?php echo "Created On"; ?></td>
				<td width="24%"><?php echo "Actions"; ?></td>
			</thead>
	   	<tbody>
           <?php

           if(!empty($blogs))
           {
              foreach($blogs as $blog)
              {
         ?>
         <tr>
            <td><?php echo $blog->title;?></td>
            <td><?php echo ($blog->status) ? 'Published':'Unpublished'; ?></td>
            <td><?php echo date('d F Y',$blog->created_time); ?></td>
            <td><a href="<?php echo base_url('admin/blogs/update_blog/'.$blog->id); ?>"><?php echo "Edit"; ?></a></td>
         </tr>

         <?php
              }
           }

           ?>
        <tr>
            <td colspan='5' style="text-align:right"><a href="<?php echo base_url('admin/blogs/create'); ?>"><?php echo "Create Blog"; ?></a></td>
        </tr>
        </tbody>
		</table>

		<div class="bottombar"> </div>

	</div>
	


</form>
</div>






