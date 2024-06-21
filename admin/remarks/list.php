<?php
    if(!isset($_SESSION['ADMIN_USERID'])){
        redirect(web_root."admin/index.php");
    }
?>

<h2>All Remarks:</h2>
<table id="dash-table" class="table table-striped table-hover table-responsive" style="font-size:12px" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Remark</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($all_remarks)): ?>
            <?php foreach ($all_remarks as $remark): ?>
                <tr>
                    <td><?php echo $remark->ID; ?></td>
                    <td><?php echo $remark->REMARK; ?></td>
                    <td>
                        <a title="Edit" href="index.php?view=edit&id=<?php echo $remark->ID; ?>" class="btn btn-primary btn-xs">
                            <span class="fa fa-edit fw-fa"></span>
                        </a>
                        <a title="Delete" href="controller.php?action=delete&id=<?php echo $remark->ID; ?>" class="btn btn-danger btn-xs">
                            <span class="fa fa-trash-o fw-fa"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No remarks found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
