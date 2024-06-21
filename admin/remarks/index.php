<?php
require_once("../../include/initialize.php");

// Check if the user is logged in as admin
if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root."admin/index.php");
    exit; // Ensure script stops after redirection
}

// Initialize Remarks object
$remarks = new Remarks();

// Fetch all remarks
$all_remarks = $remarks->all_remarks();

// Determine the view based on $_GET['view']
$view = isset($_GET['view']) ? $_GET['view'] : '';

// Define default content
$title = "Remarks / Status";
$header = $view;
switch ($view) {
    case 'list':
        $content = 'list.php';
        break;

    case 'add':
        $content = 'add.php';
        break;

    case 'edit':
        $content = 'edit.php';
        break;

    case 'view':
        $content = 'view.php';
        break;

    default:
        $content = 'list.php';
        break;
}

// Include the main template file to display the content
require_once("../theme/templates.php");
?>
