<?php 
global $mydb;
$red_id = isset($_GET['id']) ? $_GET['id'] : '';

$jobregistration = New JobRegistration();
$jobreg = $jobregistration->single_jobregistration($red_id);
// `COMPANYID`, `JOBID`, `APPLICANTID`, `APPLICANT`, `REGISTRATIONDATE`, `REMARKS`, `FILEID`, `PENDINGAPPLICATION`

$applicant = new Applicants();
$appl = $applicant->single_applicant($jobreg->APPLICANTID);
// `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `SEX`, `CIVILSTATUS`, `BIRTHDATE`, `BIRTHPLACE`, `AGE`, `USERNAME`, `PASS`, `EMAILADDRESS`,CONTACTNO

$jobvacancy = New Jobs();
$job = $jobvacancy->single_job($jobreg->JOBID);
// `COMPANYID`, `CATEGORY`, `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`, `PREFEREDSEX`, `SECTOR_VACANCY`, `JOBSTATUS`, `DATEPOSTED`

$sql = "SELECT * FROM `tblattachmentfile` WHERE `FILEID`=" .$jobreg->FILEID;
$mydb->setQuery($sql);
$attachmentfile = $mydb->loadSingleResult();


?> 

<style type="text/css">
.content-header {
    min-height: 50px;
    border-bottom: 1px solid #ddd;
    font-size: 20px;
    font-weight: bold;
}
.content-body {
    min-height: 350px;
    /*border-bottom: 1px solid #ddd;*/
}
.content-body > p {
    padding:10px;
    font-size: 12px;
    font-weight: bold;
    border-bottom: 1px solid #ddd;
}
.content-footer {
    min-height: 100px;
    border-top: 1px solid #ddd;
}
.content-footer > p {
    padding:5px;
    font-size: 15px;
    font-weight: bold; 
}
.content-footer textarea {
    width: 100%;
    height: 200px;
}
.content-footer .submitbutton {  
    margin-top: 20px;
    /*padding: 0;*/
}
</style>

<form action="controller.php?action=approve" method="POST">
<div class="col-sm-12 content-header" style="">View Details</div>
<div class="col-sm-12 content-body" >  
    <h3><?php echo $job->OCCUPATIONTITLE; ?></h3>
    <input type="hidden" name="JOBID" value="<?php echo $jobreg->REGISTRATIONID;?>">

    <div class="col-sm-6">
        <ul>
            <li><i class="fp-ht-bed"></i>No of Vacancy: <?php echo $job->REQ_NO_EMPLOYEES; ?></li>
            <li><i class="fp-ht-food"></i>Salary: <?php echo number_format($job->SALARIES, 2); ?></li>
            <li style="color: red;"><i class="fa fa-sun-"></i>Deadline for Submission: <?php echo $job->DURATION_EMPLOYMENT; ?></li>
        </ul>
    </div> 
    <div class="col-sm-6">
        <ul> 
            <li><i class="fp-ht-tv"></i>Sex: <?php echo $job->PREFEREDSEX; ?></li>
            <li><i class="fp-ht-computer"></i>Department: <?php echo $job->SECTOR_VACANCY; ?></li>
        </ul>
    </div>
    <div class="col-sm-12">
        <p>Job Description:</p>   
        <p style="margin-left: 15px;"><?php echo $job->JOBDESCRIPTION;?></p>
    </div>
    <div class="col-sm-12"> 
        <p>Qualification/Work Experience:</p>
        <p style="margin-left: 15px;"><?php echo $job->QUALIFICATION_WORKEXPERIENCE; ?></p>
    </div>
</div>

<div class="col-sm-12 content-footer">
    <p><i class="fa fa-paperclip"></i> Attachment Files</p>
    <div class="col-sm-12 slider">
        <h3>Download File <a href="<?php echo web_root.'applicant/'.$attachmentfile->FILE_LOCATION; ?>">Here</a></h3>
    </div>  
    <div class="col-sm-12">
        <p>Feedback</p>
        <p><?php echo isset($jobreg->REMARKS) ? $jobreg->REMARKS : ""; ?></p>
    </div>
    <div class="col-sm-12 submitbutton"> 
        <a href="index.php?view=appliedjobs" class="btn btn-primary fa fa-arrow-left">Back</a>
    </div> 
</div>
</form>
