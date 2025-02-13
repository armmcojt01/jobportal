<?php
require_once('include/config.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'autonumbers.php');

$autonum = new Autonumber();
$result = $autonum->auto_update('APPLICANT'); // Replace 'APPLICANT' with a valid AUTOKEY

if ($result) {
    echo "Autonumber updated successfully.";
} else {
    echo "Failed to update autonumber.";
}
?>
