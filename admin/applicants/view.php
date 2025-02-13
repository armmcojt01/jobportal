<?php 
global $mydb;
$red_id = isset($_GET['id']) ? $_GET['id'] : '';

$jobregistration = new JobRegistration();
$jobreg = $jobregistration->single_jobregistration($red_id);

$applicant = new Applicants();
$appl = $applicant->single_applicant($jobreg->APPLICANTID);

$jobvacancy = new Jobs();
$job = $jobvacancy->single_job($jobreg->JOBID);

$sql = "SELECT * FROM `tblattachmentfile` WHERE `FILEID`=" .$jobreg->FILEID;
$mydb->setQuery($sql);
$attachmentfile = $mydb->loadSingleResult();

?>
<style type="text/css">
.content-header {
	min-height: 50px;
	border-bottom: 1px solid #ddd;
	font-size: 15px;
	font-weight: bold;
}
.content-body {
	min-height: 350px;
	/*border-bottom: 1px solid #ddd;*/
}
.content-body >p {
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
.content-footer  .submitbutton{  
	margin-top: 20px;
	/*padding: 0;*/

}
</style>
<form action="controller.php?action=approve" method="POST">
<div class="col-sm-12 content-header" style="">View Details</div>
<div class="col-sm-6 content-body" > 
	<p>Job Details</p> 
	<h3><?php echo $job->OCCUPATIONTITLE; ?></h3>
	<input type="hidden" name="JOBREGID" value="<?php echo $jobreg->REGISTRATIONID;?>">
	<input type="hidden" name="APPLICANTID" value="<?php echo $appl->APPLICANTID;?>">

	<div class="col-sm-6">
		<ul>
            <li><i class="fp-ht-bed"></i>No. of Vacancy : <?php echo $job->REQ_NO_EMPLOYEES; ?></li>
            <li><i class="fp-ht-food"></i>Salary Grade: <?php echo number_format($job->SALARIES,2);  ?></li>
            <li><i class="fa fa-sun-"></i>Duration of Employment : <?php echo $job->DURATION_EMPLOYMENT; ?></li>
        </ul>
	</div> 
	<div class="col-sm-6">
		<ul> 
            <li><i class="fp-ht-tv"></i>Sex : <?php echo $job->PREFEREDSEX; ?></li>
            <li><i class="fp-ht-computer"></i>Department : <?php echo $job->SECTOR_VACANCY; ?></li>
        </ul>
	</div>
	<div class="col-sm-12">
		<p>Job Description : </p>   
		<p style="margin-left: 15px;"><?php echo $job->JOBDESCRIPTION;?></p>
	</div>
	<div class="col-sm-12"> 
		<p>Qualification/Work Experience : </p>
		<p style="margin-left: 15px;"><?php echo $job->QUALIFICATION_WORKEXPERIENCE; ?></p>
	</div>
</div>
<div class="col-sm-6 content-body" >
	<p>Applicant Information</p> 
	<h3> <?php echo $appl->LNAME. ', ' .$appl->FNAME . ' ' . $appl->MNAME;?></h3>
	<ul> 
		<li>Address : <?php echo $appl->ADDRESS; ?></li>
		<li>Contact No. : <?php echo $appl->CONTACTNO;?></li>
		<li>Email Address. : <?php echo $appl->EMAILADDRESS;?></li>
		<li>Sex: <?php echo $appl->SEX;?></li>
		<li>Age : <?php echo $appl->AGE;?></li> 
	</ul>
	<div class="col-sm-12"> 
		<p>Highest Educational Attainment : </p>
		<p style="margin-left: 15px;"><?php echo $appl->DEGREE;?></p>
	</div>


</div> 
<div class="col-sm-12 content-footer">
<p><i class="fa fa-paperclip"></i>  Attachment Files</p>
					<?php
					if ($attachmentfile && !empty($attachmentfile->FILE_LOCATION)) {
						echo "File Location: " . $attachmentfile->FILE_LOCATION;
					} else {
						echo "No attached file found.";
					}
					?>
            <p>Select Status :</p>
            <textarea class="input-group" name="REMARKS_ID"><?php echo isset($jobreg->REMARK) ? $jobreg->REMARK_ID: ""; ?></textarea>
        </div>
	<div class="col-sm-12  submit button "> 
		<button type="submit" name="submit" class="btn btn-primary">Send</button>
	</div> 
</div>
</form>