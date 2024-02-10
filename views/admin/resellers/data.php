
    <?php for ($i = 0; $i < count($results); ++$i) { ?>
    <tr>
        <td><?php echo ($page+$i+1); ?></td>
        <td><?php echo $results[$i]->EmpName; ?></td>
        <td><?php echo $results[$i]->DeptName; ?></td>
        <td><?php echo $results[$i]->Designation; ?></td>
        <td><?php echo $results[$i]->DOJ; ?></td>
        <td><?php echo $results[$i]->Salary; ?></td>
    </tr>
    <?php } ?>
    
<div id="ajax_links" class="text-center">
    <?php echo $links; ?>
</div>