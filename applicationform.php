<?php
// Retrieve JOBID from URL parameter
$jobid = isset($_GET['job']) ? $_GET['job'] : 0; // Assuming 'job' is the correct parameter name

// Fetch job details based on JOBID
$sql = "SELECT * FROM `tbljob` WHERE JOBID = '{$jobid}'";
$mydb->setQuery($sql);
$result = $mydb->loadSingleResult();

if (!$result) {
    // Handle case where job with given ID is not found
    echo "Job not found.";
    exit; // or redirect to a 404 page
}
?>
  <div class="hero-wrap js-fullheight" style="background-image: url('<?php echo web_root; ?>plugins/jobportal/images/recruitment.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center text-md-left mb-5" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-3"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Apply Now</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Apply Now</h1>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <h2 class="page-header">Job Details</h2>
        </div>
        <div class="row block-9">
            <div class="col-md-6 order-md-last d-flex">
                <form class="form-horizontal span6 wow fadeInDown" action="process.php?action=submitapplication&JOBID=<?php echo $result->JOBID; ?>" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <?php require_once('applicantform.php'); ?>
                </form>
            </div>
            <div class="col-md-6 d-flex">
                <div class="panel">
                    <div class="panel-header">
                        <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;">
                            <a href="<?php echo web_root.'index.php?q=viewjob&search='.$result->JOBID; ?>"><?php echo $result->OCCUPATIONTITLE; ?></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row content body">
                            <div class="col-md-6">
                                <ul>
                                    <li><i class="fp-ht-bed"></i>No. of Vacancy : <?php echo $result->REQ_NO_EMPLOYEES; ?></li>
                                    <li><i class="fp-ht-food"></i>Salary Grade : <?php echo $result->SALARIES; ?></li>
                                    <li>Date Posted : <?php echo date_format(date_create($result->DATEPOSTED), 'M d, Y'); ?></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><i class="fp-ht-tv"></i>Sex : <?php echo $result->PREFEREDSEX; ?></li>
                                    <li><i class="fp-ht-computer"></i>Department : <?php echo $result->SECTOR_VACANCY; ?></li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <p>Qualification/Work Experience :</p>
                                <ul style="list-style: none;">
                                    <li><?php echo $result->QUALIFICATION_WORKEXPERIENCE; ?></li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <p>Job Description:</p>
                                <ul style="list-style: none;">
                                    <li><?php echo $result->JOBDESCRIPTION; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer" style="color: red;">
                        <i class="fa fa-sun"></i> Deadline of submission : <?php echo $result->DURATION_EMPLOYMENT; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>