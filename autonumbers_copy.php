<?php
require_once('include/autonumbers.php');

$autonum = new Autonumber();

// Retrieve the autonumber
$result = $autonum->set_autonumber('APPLICANT');
if ($result) {
    echo "Generated AUTO number for APPLICANT: " . $result->AUTO . "<br>";
    
    // Update the autonumber
    if ($autonum->auto_update('APPLICANT')) {
        echo "<script>alert('Autonumber updated successfully.'); window.location.href = 'applicant_window.php';</script>";
    } else {
        echo "<script>alert('Failed to update autonumber.'); window.location.href = 'applicant_window.php';</script>";
    }
} else {
    echo "<script>alert('Failed to retrieve autonumber for APPLICANT.'); window.location.href = 'applicant_window.php';</script>";
}
?>
