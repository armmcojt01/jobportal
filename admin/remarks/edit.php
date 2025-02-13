<?php
require_once("../../include/initialize.php");

// Check if user is authenticated
if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}

// Initialize Remarks object
$remarks = new Remarks();

// Get remark ID from query string
$remark_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch single remark based on ID
$singleremark = $remarks->single_remark($remark_id);

// Check if $singleremark is found
if (!$singleremark) {
    $_SESSION['error'] = "Remark not found.";
    redirect("index.php"); // Redirect back to index or appropriate page
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update remark object with form data
    $singleremark->ID = $_POST['ID'];
    $singleremark->REMARK = $_POST['REMARK'];

    // Save updated remark
    if ($singleremark->save()) {
        $_SESSION['message'] = "Remark updated successfully!";
        redirect("index.php");
    } else {
        $_SESSION['error'] = "Failed to update remark.";
    }
}
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
            <li class="active">Edit Remark</li>
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
                                <label for="REMARK">Remark</label>
                                <input type="text" class="form-control" id="REMARK" name="REMARK" value="<?php echo $singleremark->REMARK; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Remark</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
