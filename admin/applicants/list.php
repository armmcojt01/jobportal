<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">List of Applicant's</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<form class="wow fadeInDown action" action="controller.php?action=delete" Method="POST">
    <table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">

        <thead>
            <tr>
                <th>Applicant</th>
                <th>Job Title</th>
                <th>Applied Date</th>
                <th>Remarks</th>
                <th width="14%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
					$mydb->setQuery("
					SELECT j.*, j2.OCCUPATIONTITLE, CONCAT(a.FNAME, ' ', a.MNAME, ' ', a.LNAME) AS FULL_NAME, j.REGISTRATIONDATE, r.REMARK, c.CATEGORY
					FROM `tbljobregistration` j
					INNER JOIN `tbljob` j2 ON j.`JOBID` = j2.`JOBID`
					INNER JOIN `tblapplicants` a ON j.`APPLICANTID` = a.`APPLICANTID`
					INNER JOIN `tblremarks` r ON j.`REMARKS_ID` = r.`ID`
					INNER JOIN `tblcategory` c ON j.`CATEGORY_ID` = c.`CATEGORYID`
					");
					$cur = $mydb->loadResultList();

					foreach ($cur as $result) {
						echo '<tr>';
						echo '<td>' . $result->FULL_NAME . '</td>';
						echo '<td>' . $result->OCCUPATIONTITLE . '</td>';
						echo '<td>' . $result->REGISTRATIONDATE . '</td>';
						echo '<td>' . $result->CATEGORY . '</td>'; // Display CATEGORY from tblcategory
						echo '<td>' . $result->REMARK . '</td>'; // Display REMARK from tblremarks
						echo '<td align="center">    
							<a title="View" href="index.php?view=view&id=' . $result->REGISTRATIONID . '" class="btn btn-info btn-xs">
								<span class="fa fa-info fw-fa"></span> View
							</a> 
							<a title="Remove" href="controller.php?action=delete&id=' . $result->REGISTRATIONID . '" class="btn btn-danger btn-xs">
								<span class="fa fa-trash-o fw-fa"></span> Remove
							</a> 
						</td>';
						echo '</tr>';
					}
					?>
        </tbody>

    </table>


</form>
