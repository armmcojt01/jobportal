<?php
require_once ("../../include/initialize.php");
require_once("../../include/employees.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        doInsert();
        break;

    case 'edit':
        doEdit();
        break;

    case 'delete':
        doDelete();
        break;

    case 'photos':
        doupdateimage();
        break;

    case 'addfiles':
        doAddFiles();
        break;

    case 'checkid':
        Check_StudentID();
        break;

    default:
        // Handle invalid action
        break;
}
   
function doInsert() {
    global $mydb;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        $requiredFields = ['FNAME', 'LNAME', 'MNAME', 'ADDRESS', 'TELNO', 'BIRTHDATE', 'EMPLOYEEID', 'EMP_HIREDDATE', 'BIRTHPLACE', 'CIVILSTATUS', 'POSITION', 'EMP_EMAILADDRESS', 'CATEGORYID'];

        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                message("All fields are required!", "error");
                redirect('index.php?view=add');
                return;
            }
        }

        $birthdate = date('Y-m-d', strtotime($_POST['BIRTHDATE']));
        $age = date_diff(date_create($birthdate), date_create('today'))->y;

        if ($age < 20) {
            message("Invalid age. 20 years old and above is allowed.", "error");
            redirect("index.php?view=add");
            return;
        }

        $sql = "SELECT * FROM tblemployees WHERE EMPLOYEEID = '" . $_POST['EMPLOYEEID'] . "'";
        $mydb->setQuery($sql);
        $cur = $mydb->executeQuery();
        $maxrow = $mydb->num_rows($cur);

        if ($maxrow > 0) {
            message("Employee ID already in use!", "error");
            redirect("index.php?view=add");
            return;
        }

        $datehired = date('Y-m-d', strtotime($_POST['EMP_HIREDDATE']));
        $emp = new Employee();
        $emp->EMPLOYEEID = $_POST['EMPLOYEEID'];
        $emp->FNAME = $_POST['FNAME'];
        $emp->LNAME = $_POST['LNAME'];
        $emp->MNAME = $_POST['MNAME'];
        $emp->ADDRESS = $_POST['ADDRESS'];
        $emp->BIRTHDATE = $birthdate;
        $emp->BIRTHPLACE = $_POST['BIRTHPLACE'];
        $emp->AGE = $age;
        $emp->SEX = $_POST['optionsRadios'];
        $emp->TELNO = $_POST['TELNO'];
        $emp->CIVILSTATUS = $_POST['CIVILSTATUS'];
        $emp->POSITION = trim($_POST['POSITION']);
        $emp->EMP_EMAILADDRESS = $_POST['EMP_EMAILADDRESS'];
        $emp->EMPUSERNAME = $_POST['EMPLOYEEID'];
        $emp->EMPPASSWORD = password_hash($_POST['EMPLOYEEID'], PASSWORD_BCRYPT);
        $emp->DATEHIRED = $datehired;
        $emp->CATEGORYID = $_POST['CATEGORYID'];
        $emp->create();

        $user = new User();
        $user->USERID = $_POST['EMPLOYEEID'];
        $user->FULLNAME = $_POST['FNAME'] . ' ' . $_POST['LNAME'];
        $user->USERNAME = $_POST['LNAME'];
        $user->PASS = password_hash($_POST['EMPLOYEEID'], PASSWORD_BCRYPT);
        $user->ROLE = 'Employee';
        $user->create();

        $autonum = new Autonumber();
        $autonum->auto_update('employeeid');

        message("New employee created successfully!", "success");
        redirect("index.php");
    }
}
function doEdit() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        $requiredFields = ['FNAME', 'LNAME', 'MNAME', 'ADDRESS', 'TELNO', 'BIRTHDATE', 'EMPLOYEEID', 'EMP_HIREDDATE', 'BIRTHPLACE', 'CIVILSTATUS', 'POSITION', 'EMP_EMAILADDRESS', 'CATEGORYID'];

        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                message("All fields are required!", "error");
                redirect('index.php?view=edit&id=' . $_POST['EMPLOYEEID']);
                return;
            }
        }

        $birthdate = date('Y-m-d', strtotime($_POST['BIRTHDATE']));
        $age = date_diff(date_create($birthdate), date_create('today'))->y;

        if ($age < 20) {
            message("Invalid age. 20 years old and above is allowed.", "error");
            redirect("index.php?view=edit&id=" . $_POST['EMPLOYEEID']);
            return;
        }

        $datehired = date('Y-m-d', strtotime($_POST['EMP_HIREDDATE']));
        $emp = new Employee();
        $emp->EMPLOYEEID = $_POST['EMPLOYEEID'];
        $emp->FNAME = $_POST['FNAME'];
        $emp->LNAME = $_POST['LNAME'];
        $emp->MNAME = $_POST['MNAME'];
        $emp->ADDRESS = $_POST['ADDRESS'];
        $emp->BIRTHDATE = $birthdate;
        $emp->BIRTHPLACE = $_POST['BIRTHPLACE'];
        $emp->AGE = $age;
        $emp->SEX = $_POST['optionsRadios'];
        $emp->TELNO = $_POST['TELNO'];
        $emp->CIVILSTATUS = $_POST['CIVILSTATUS'];
        $emp->POSITION = trim($_POST['POSITION']);
        $emp->EMP_EMAILADDRESS = $_POST['EMP_EMAILADDRESS'];
        $emp->EMPUSERNAME = $_POST['EMPLOYEEID'];
        $emp->EMPPASSWORD = password_hash($_POST['EMPLOYEEID'], PASSWORD_BCRYPT);
        $emp->DATEHIRED = $datehired;
        $emp->CATEGORY = $_POST['CATEGORYID'];

        if ($emp->update($_POST['EMPLOYEEID'])) {
            updateOrCreateUser($_POST);
            message("Employee has been updated!", "success");
        } else {
            message("Error updating employee details!", "error");
        }
        redirect("index.php?view=edit&id=" . $_POST['EMPLOYEEID']);
    }
}

function updateOrCreateUser($postData) {
    $user = new User();
    $existingUser = $user->single_user($postData['EMPLOYEEID']);

    if ($existingUser) {
        $user->FULLNAME = $postData['FNAME'] . ' ' . $postData['LNAME'];
        $user->USERNAME = $postData['LNAME'];
        $user->PASS = password_hash($postData['EMPLOYEEID'], PASSWORD_BCRYPT);
        $user->update($postData['EMPLOYEEID']);
    } else {
        $user->USERID = $postData['EMPLOYEEID'];
        $user->FULLNAME = $postData['FNAME'] . ' ' . $postData['LNAME'];
        $user->USERNAME = $postData['LNAME'];
        $user->PASS = password_hash($postData['EMPLOYEEID'], PASSWORD_BCRYPT);
        $user->ROLE = 'Employee';
        $user->create();
    }
}

function doDelete() {
    $id = $_GET['id'] ?? null;

    if ($id) {
        $emp = new Employee();
        $emp->delete($id);

        message("Employee(s) already Deleted!", "success");
    } else {
        message("Invalid Employee ID!", "error");
    }

    redirect('index.php');
}
 
 
  function UploadImage(){
			$target_dir = "../../employee/photos/";
			$target_file = $target_dir . date("dmYhis") . basename($_FILES["picture"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			
			if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
		|| $imageFileType != "gif" ) {
				 if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
					return  date("dmYhis") . basename($_FILES["picture"]["name"]);
				}else{
					echo "Error Uploading File";
					exit;
				}
			}else{
					echo "File Not Supported";
					exit;
				}
} 

function doupdateimage() {
    if ($_FILES['photo']['error'] > 0) {
        message("No Image Selected!", "error");
        redirect("index.php?view=view&id=" . $_GET['id']);
        return;
    }

    $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($imageFileType, $allowedTypes)) {
        message("Uploaded file is not a valid image!", "error");
        redirect("index.php?view=view&id=" . $_GET['id']);
        return;
    }

    $target_dir = "../../employee/photos/";
    $target_file = $target_dir . date("dmYhis") . basename($_FILES["photo"]["name"]);

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $stud = new Student();
        $stud->StudPhoto = $target_file;
        $stud->studupdate($_POST['StudentID']);
        redirect("index.php?view=view&id=" . $_POST['StudentID']);
    } else {
        message("Error uploading file", "error");
        redirect("index.php?view=view&id=" . $_POST['StudentID']);
    }
}
?>