
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2>Certificate Report</h2></div>
	</div>
</div>


<div class="content">
	<div class="clr"></div>

	<table class="adminlist" width="100%">
    <thead>
          <tr>
				        <th>Course</th>
				        <th>Enrolled User</th>
				        <th>Certificate Status</th>
				        <th>Action</th>
				        <th></th>
                    </tr>
    </thead>
                <tbody>
                 <?php
                     $this->load->model('admin/Userreport_model');
                 ?>

                 <!-- list of all all courses having enrolled student and also has final exam id set -->
                 <?php
                    foreach($enrollcertidetail as $eachdetail){
                 ?>
                        <tr>
    				        <td><?php echo $this->Userreport_model->getProgramName($eachdetail['course_id']);?></td>
    				        <td><?php echo $this->Userreport_model->getUserName($eachdetail['userid']); ?></td>
    				        <td><?php echo $eachdetail['certification'];?></td>
    				        <td>

                                <a href="<?php echo base_url(); ?>admin/usercertireport/viewcertificate/<?php echo $eachdetail['finalexamid']; ?>">
<img align="viewed" src="<?php echo base_url();?>public/default/images/viewed.png" title="View And Approve Certificate">

          </a>

                            </td>
    				        <td></td>
                        </tr>
                 <?php
                  }
                 ?>

			   </tbody>
    </table>
</div>
<script>
     function openWinCertificateApproval(qtid)
    {
        myWindow=window.open('<?php echo base_url(); ?>/admin/usercertireport/viewcertificate/'+qtid,'','width=800,height=600, resizable = 0');
        myWindow.focus();
    }
</script>