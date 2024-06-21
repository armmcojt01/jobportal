<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if (!isset($_GET['p'])) { ?>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Applied Jobs</h3>
                        </div>
                        <div class="box-body no-padding">
                            <div class="table-responsive mailbox-messages">
                                <table id="dash-table" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Job Title</th>
                                            <th>Position Applied</th>
                                            <th>Salary Grade</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Assuming the applicant's ID is stored in a session variable
                                        $applicantID = $_SESSION['APPLICANTID'];
                                        if (!$applicantID) {
                                            echo '<tr><td colspan="4">No applicant ID found in session.</td></tr>';
                                        } else {
                                            // Fetch job registrations for the specific applicant
                                            $sql = "SELECT j.OCCUPATIONTITLE, j.SALARIES, r.REGISTRATIONID, IFNULL(rm.REMARK, 'No remarks available') AS REMARK
                                                    FROM tbljobregistration r
                                                    JOIN tbljob j ON r.JOBID = j.JOBID
                                                    LEFT JOIN tblremarks rm ON r.REMARKS_ID = rm.ID
                                                    WHERE r.APPLICANTID = '$applicantID'";
                                            $mydb->setQuery($sql);
                                            $cur = $mydb->loadResultList();
                                            if (count($cur) > 0) {
                                                foreach ($cur as $result) {
                                                    echo '<tr>';
                                                    echo '<td class="mailbox-star"><a href="index.php?view=appliedjobs&p=job&id=' . $result->REGISTRATIONID . '"><i class="fa fa-pencil-o text-yellow"></i> ' . $result->OCCUPATIONTITLE . '</a></td>';
                                                    echo '<td class="mailbox-attachment">' . $result->OCCUPATIONTITLE . '</td>';
                                                    echo '<td class="mailbox-attachment">' . $result->SALARIES . '</td>';
                                                    
                                                    // Display remarks
                                                    echo '<td class="mailbox-attachment"><p style="color: blue; animation: blinker 1s linear infinite; font-weight: bold;">' . $result->REMARK . '</p></td>';
                                                    
                                                    echo '</tr>';
                                                }
                                            } else {
                                                echo '<tr><td colspan="4">No applied jobs found for this applicant.</td></tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else {
                require_once("viewjob.php");
            } ?>
        </div>
    </section>
</div>