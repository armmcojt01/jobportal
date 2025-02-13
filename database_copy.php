<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('include/initialize.php');

try {
    $fileID = '202400003';
    $userAttachmentID = '2024022';
    $fileName = 'Resume';
    $fileLocation = 'photos/testfile.pdf';
    $jobID = '12';

    // Check if the FILEID already exists
    $checkSql = "SELECT COUNT(*) FROM tblattachmentfile WHERE FILEID = :fileID";
    $stmt = $mydb->conn->prepare($checkSql);
    $stmt->execute(['fileID' => $fileID]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // If exists, update the existing record
        $updateSql = "UPDATE tblattachmentfile
                      SET USERATTACHMENTID = :userAttachmentID,
                          FILE_NAME = :fileName,
                          FILE_LOCATION = :fileLocation,
                          JOBID = :jobID
                      WHERE FILEID = :fileID";
        $stmt = $mydb->conn->prepare($updateSql);
        $result = $stmt->execute([
            'fileID' => $fileID,
            'userAttachmentID' => $userAttachmentID,
            'fileName' => $fileName,
            'fileLocation' => $fileLocation,
            'jobID' => $jobID
        ]);

        if ($result) {
            echo "Record updated successfully.";
        } else {
            echo "Update failed.";
        }
    } else {
        // If not exists, insert the new record
        $insertSql = "INSERT INTO tblattachmentfile (FILEID, USERATTACHMENTID, FILE_NAME, FILE_LOCATION, JOBID) 
                      VALUES (:fileID, :userAttachmentID, :fileName, :fileLocation, :jobID)";
        $stmt = $mydb->conn->prepare($insertSql);
        $result = $stmt->execute([
            'fileID' => $fileID,
            'userAttachmentID' => $userAttachmentID,
            'fileName' => $fileName,
            'fileLocation' => $fileLocation,
            'jobID' => $jobID
        ]);

        if ($result) {
            echo "Query executed successfully.";
        } else {
            echo "Insert failed.";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
