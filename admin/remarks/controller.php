<?php
require_once("../../include/initialize.php");
if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/login.php");
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'delete':
        $remark = new Remarks();
        $remark->delete($_GET['id']);
        $_SESSION['message'] = "Remark deleted successfully!";
        redirect("index.php");
        break;
}
?>
