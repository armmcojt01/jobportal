<?php
require_once("../include/initialize.php");

// Get the number of vacancies
$vacancy_query = "SELECT COUNT(*) as count FROM tbljob";
$mydb->setQuery($vacancy_query);
$vacancy_result = $mydb->loadSingleResultAssoc();
$vacancy_count = $vacancy_result['count'];

// Get the number of applicants
$applicant_query = "SELECT COUNT(*) as count FROM tblapplicants";
$mydb->setQuery($applicant_query);
$applicant_result = $mydb->loadSingleResultAssoc();
$applicant_count = $applicant_result['count'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <!-- Include your styles and scripts here -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/ionicons/css/ionicons.min.css">
    <!-- Add your other stylesheets here -->
</head>
<body>
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $vacancy_count; ?></h3>
                    <p>No of Vacancy</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="../admin/vacancy" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $applicant_count; ?></h3>
                    <p>No of Applicant/s</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="../admin/applicants" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>    
    </section>
</body>
</html>
