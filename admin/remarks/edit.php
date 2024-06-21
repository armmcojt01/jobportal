<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}

$REMARK = $_GET['id'];
if($REMARK==''){
redirect("index.php");
}
$remark_id = New Remarks();
$singleremark = $remark->single_remark($REMARK_ID);

?> 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Remark</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

            <section class="content-header">
                <h1>Edit Remark</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form method="POST" action="edit.php?id=<?php echo $remark_id; ?>">
                                    <input type="hidden" name="ID" value="<?php echo $singleremark->ID; ?>">
                                    <div class="form-group">
                                        <label for="remark">Remark</label>
                                        <input type="text" class="form-control" id="remark" name="REMARK" value="<?php echo $singleremark->REMARK; ?>" required>
                                    </div>
                                    <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Update Remarks</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>