<?php
$this->load->model('admin/Transaction_model');
?>
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2>Payment Transaction</h2></div>
	</div>
</div>


<div class="content">
	<div class="clr"></div>

	<table class="adminlist" width="100%">
    <thead>
          <tr>
				        <th>Sr.No</th>
				        <th>User ID</th>
				        <th>User Name</th>
				        <th>Course</th>
				        <th>Price</th>
				        <th>Plan</th>
				        <th>Ordered Date</th>
				        <th>Amount</th>
				        <th>Amt Paid</th>
				        <th>Status</th>
          </tr>
    </thead>
                <tbody>

                <?php


                 $i=1;
                  foreach($alltrans1 as $eachtran)
                  {
                ?>
        <tr>            <td><?php echo $eachtran['id'];?></td>
				        <td><?php echo $eachtran['userid']; ?></td>
				        <td><?php echo $this->Transaction_model->getUserName($eachtran['userid']); ?></td>
				        <td><?php echo $eachtran['courses']; ?></td>
				        <td><?php echo $eachtran['order_date']; ?></td>
				        <td><?php echo $eachtran['amount']; ?></td>
				        <td><?php echo $eachtran['amount_paid']; ?></td>
				        <td>
                        <?php
                        if($eachtran['status']=='Pending')
                        {
                        ?>
                        <a href="<?php echo base_url(); ?>admin/transaction/paid/<?php echo $eachtran['id'];?>/" style="text-decoration:none" ><?php echo $eachtran['status']; ?></a>
                        <?php
                        }
                        else
                        {
                        ?>
                        <a href="<?php echo base_url(); ?>admin/transaction/pending/<?php echo $eachtran['id'];?>/" style="text-decoration:none" ><?php echo $eachtran['status']; ?></a>
                        <?php
                        }
                        ?>
                       </td>
        </tr>
                <?php
                $i++;
                  }
                ?>


			   </tbody>
    </table>
    <div  style="text-align:center">
            <?php echo $pages; ?>
    </div>
</div>
